<?php

namespace App\Jobs;

use App\InstagramAccount;
use App\InstagramAccountScrape;
use App\User;
use App\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Instagram\Api;

class ScrapeInstagramAccount implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    protected $username;
    protected $user;
    protected $save;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($username, User $user = null, $save = true)
    {
        $this->username = str_replace('@', '', $username);
        $this->user = $user;
        $this->save = $save;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //Define variables
        $medias = [];
        $hashtags = [];
        $locations = [];
        $users = [];
        $biography_hashtags = [];
        $biography_users = [];
        $postLikes = [];
        $postComments = [];
        $website_id = null;
        $user_id = null;
        $avg_dataset_start = null;
        $avg_dataset_end = null;

        try {
            $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
            $cachePool = cache('key', 0);

            $api = new Api($cachePool);
            $api->login(config('blog.instagram_username'), config('blog.instagram_password'));

            $profile = $api->getProfile($this->username);
            $medias = $profile->getMedias();

            // $medias = $profile->getMedias();
            // do {
            //     $profile = $api->getMoreMedias($profile);
            //     array_push($medias, $profile->getMedias());

            //     // avoid 429 Rate limit from Instagram
            //     sleep(1);
            // } while ($profile->hasMoreMedias());

            //quick hack to convert to nested obj

            // return $medias;

            $profile->videos_count = 0;
            $profile->pictures_count = 0;
            $profile->avgPostLikes = 0;
            $profile->avgPostComments = 0;
        } catch (Exception $e) {
            return $e;
        }

        $account = InstagramAccount::where('instagram_id', $profile->getId())->orWhere('username', $profile->getUserName())->withCount('scrapes')->first();

        if (!$account || !isset($account->id)) {
            $account = InstagramAccount::create(
                ['username' => $profile->getUserName(),
                    'instagram_id' => $profile->getId(),
                    'is_scrapeable' => 1]
            );
        } else {
            $account->update(['username' => $profile->getUserName(), 'instagram_id' => $profile->getId()]);
        }

        //loop and proccess the hashtags mentioned in biography
        preg_match_all('/#(\w+)/', $profile->getBiography(), $matchesForHashtagsInCaption);
        foreach ($matchesForHashtagsInCaption[1] as $match) {
            if (!in_array($match, $biography_hashtags)) {
                $biography_hashtags[] .= $match;
            }
        }

        //loop and proccess the users mentioned in biography
        preg_match_all('/@([\w\.]+)/', $profile->getBiography(), $matchesForUsersInCaption);
        foreach ($matchesForUsersInCaption[1] as $match) {
            if (!in_array($match, $biography_users)) {
                $biography_users[] .= $match;
                // InstagramAccount::firstOrCreate(
                //     ['username' => $match]
                // );
            }
        }

        //loop and proccess the medias
        foreach ($medias as $media) {
            // array_push($medias, $media);
            //$hashtags[] .= $media['caption'];

            //loop and proccess the hashtags mentioned in the post
            preg_match_all('/#(\w+)/', $media->getCaption(), $matches);
            foreach ($matches[1] as $match) {
                if (!in_array($match, $hashtags)) {
                    $hashtags[] .= $match;
                }
            }

            //loop and proccess the users mentioned in the post
            preg_match_all('/@([\w\.]+)/', $media->getCaption(), $matchesForUsers);
            foreach ($matchesForUsers[1] as $match) {
                if (!in_array($match, $users)) {
                    // InstagramAccount::firstOrCreate(
                    //     ['username' => $match]
                    // );
                    $users[] .= $match;
                }
            }

            $postLikes[] .= $media->getLikes();
            $postComments[] .= $media->getComments();

            if ($media->isVideo()) {
                $profile->videos_count++;
            } else {
                $profile->pictures_count++;
            }

            if ($media->getLocation()) {
                $locations[$media->getLocation()->id] = ['id' => $media->getLocation()->id, 'name' => $media->getLocation()->name, 'slug' => $media->getLocation()->slug, 'has_public_page' => $media->getLocation()->has_public_page];
            }
        }

        $profile->avgPostLikes = count($postLikes) > 0 ? array_sum($postLikes) / count($postLikes) : null;
        $profile->avgPostComments = count($postComments) > 0 ? array_sum($postComments) / count($postComments) : null;

        //combine arrays from caption data and post data
        $users = array_unique(array_merge($users, $biography_users));
        $hashtags = array_unique(array_merge($hashtags, $biography_hashtags));

        if ($this->user) {
            $user_id = $this->user->id;
        }

        if ($profile->getExternalUrl()) {
            $parsed_url = parse_url($profile->getExternalUrl());
            $website = Website::firstOrCreate(
                ['host' => $parsed_url['host']],
                ['scheme' => $parsed_url['scheme'], 'user_id' => $account->user_id ?? null]
                //['is_scrapeable' => $profile->isPrivate() ? 0 : 1]
            );
            $website_id = $website->id;
        }

        if ($profile->getMediaCount() && !$profile->isPrivate()) {
            $avg_dataset_start = \Carbon\Carbon::parse(end($medias)->getDate());
            $avg_dataset_end = \Carbon\Carbon::parse(reset($medias)->getDate());
        }

        if ($account->is_scrapeable && $this->save == true) {
            $scraped_data = InstagramAccountScrape::create([
                'instagram_account_id' => $account->id,
                'username' => $profile->getUserName(),
                'full_name' => $profile->getFullName(),
                'biography' => $profile->getBiography(),
                'profile_picture_url' => $profile->getProfilePicture(),
                'external_url' => $profile->getExternalUrl(),
                'website_id' => $website_id,
                'media_count' => $profile->getMediaCount(),
                'followers_count' => $profile->getFollowers(),
                'following_count' => $profile->getFollowing(),
                'avg_likes_count' => $profile->avgPostLikes,
                'avg_comments_count' => $profile->avgPostComments,
                'avg_dataset_start' => $avg_dataset_start,
                'avg_dataset_end' => $avg_dataset_end,
                'avg_dataset_photos_count' => $profile->pictures_count,
                'avg_dataset_videos_count' => $profile->videos_count,
                'is_private' => $profile->isPrivate(),
                'is_verified' => $profile->isVerified(),
                'user_id' => $user_id,
            ]);
            if ($avg_dataset_end && now()->subMonths(3) >= $avg_dataset_end) {
                $account->is_scrapeable = 0;
                $account->save();
            }
        } else {
            $scraped_data = (object) [
                'instagram_account_id' => $account->id,
                'username' => $profile->getUserName(),
                'full_name' => $profile->getFullName(),
                'biography' => $profile->getBiography(),
                'profile_picture_url' => $profile->getProfilePicture(),
                'external_url' => $profile->getExternalUrl(),
                'website_id' => $website_id,
                'media_count' => $profile->getMediaCount(),
                'followers_count' => $profile->getFollowers(),
                'following_count' => $profile->getFollowing(),
                'avg_likes_count' => $profile->avgPostLikes,
                'avg_comments_count' => $profile->avgPostComments,
                'avg_dataset_start' => $avg_dataset_start,
                'avg_dataset_end' => $avg_dataset_end,
                'avg_dataset_photos_count' => $profile->pictures_count,
                'avg_dataset_videos_count' => $profile->videos_count,
                'is_private' => $profile->isPrivate(),
                'is_verified' => $profile->isVerified(),
                'user_id' => $user_id,
                'created_at' => now(),
            ];
        }

        return compact('scraped_data', 'hashtags', 'locations', 'users', 'account', 'medias');
        //return response()->json($data);
    }
}
