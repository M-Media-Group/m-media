<?php
namespace App\Jobs;

use App\InstagramAccount;
use App\InstagramAccountScrape;
use App\User;
use App\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapeInstagramAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $username;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($username, User $user = null)
    {
        $this->username = str_replace("@", "", $username);
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        #Define variables
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
            $api = new \Instagram\Api();
            $api->setUserName($this->username);
            $obj = $api->getFeed();

            #quick hack to convert to nested obj
            $data = json_decode(json_encode($obj));

            $data->videos_count = 0;
            $data->pictures_count = 0;
            $data->avgPostLikes = 0;
            $data->avgPostComments = 0;
        } catch (Exception $e) {
            return $e;
        }

        $account = InstagramAccount::where('instagram_id', $data->id)->orWhere('username', $data->userName)->first();

        if (!$account || !isset($account->id)) {
            $account = InstagramAccount::create(
                ['username' => $data->userName,
                    'instagram_id' => $data->id,
                    'is_scrapeable' => 1]
            );
        } else {
            $account->update(['username' => $data->userName, 'instagram_id' => $data->id]);
        }

        #loop and proccess the hashtags mentioned in biography
        preg_match_all('/#(\w+)/', $data->biography, $matchesForHashtagsInCaption);
        foreach ($matchesForHashtagsInCaption[1] as $match) {
            if (!in_array($match, $biography_hashtags)) {
                $biography_hashtags[] .= $match;
            }
        }

        #loop and proccess the users mentioned in biography
        preg_match_all('/@([\w, \.]+)/', $data->biography, $matchesForUsersInCaption);
        foreach ($matchesForUsersInCaption[1] as $match) {
            if (!in_array($match, $biography_users)) {
                $biography_users[] .= $match;
                // InstagramAccount::firstOrCreate(
                //     ['username' => $match]
                // );
            }
        }

        #loop and proccess the medias
        foreach ($data->medias as $media) {
            array_push($medias, $media);
            //$hashtags[] .= $media['caption'];

            #loop and proccess the hashtags mentioned in the post
            preg_match_all('/#(\w+)/', $media->caption, $matches);
            foreach ($matches[1] as $match) {
                if (!in_array($match, $hashtags)) {
                    $hashtags[] .= $match;
                }
            }

            #loop and proccess the users mentioned in the post
            preg_match_all('/@([\w, \.]+)/', $media->caption, $matchesForUsers);
            foreach ($matchesForUsers[1] as $match) {
                if (!in_array($match, $users)) {
                    // InstagramAccount::firstOrCreate(
                    //     ['username' => $match]
                    // );
                    $users[] .= $match;
                }
            }

            $postLikes[] .= $media->likes;
            $postComments[] .= $media->comments;

            if ($media->video) {
                $data->videos_count++;
            } else {
                $data->pictures_count++;
            }

            if ($media->location) {
                $locations[$media->location->id] = ['id' => $media->location->id, 'name' => $media->location->name, 'slug' => $media->location->slug, 'has_public_page' => $media->location->has_public_page];
            }
        }

        $data->avgPostLikes = count($postLikes) > 0 ? array_sum($postLikes) / count($postLikes) : null;
        $data->avgPostComments = count($postComments) > 0 ? array_sum($postComments) / count($postComments) : null;

        #combine arrays from caption data and post data
        $users = array_unique(array_merge($users, $biography_users));
        $hashtags = array_unique(array_merge($hashtags, $biography_hashtags));

        if ($data->externalUrl) {
            $parsed_url = parse_url($data->externalUrl);
            $website = Website::firstOrCreate(
                ['host' => $parsed_url['host']],
                ['scheme' => $parsed_url['scheme']]
                //['is_scrapeable' => $data->private ? 0 : 1]
            );
            $website_id = $website->id;
        }

        if ($this->user) {
            $user_id = $this->user->id;
        }

        if ($data->mediaCount && !$data->private) {
            $avg_dataset_start = \Carbon\Carbon::parse(end($data->medias)->date->date);
            $avg_dataset_end = \Carbon\Carbon::parse(reset($data->medias)->date->date);
        }

        if ($account->is_scrapeable) {
            $scraped_data = InstagramAccountScrape::create([
                'instagram_account_id' => $account->id,
                'username' => $data->userName,
                'full_name' => $data->fullName,
                'biography' => $data->biography,
                'profile_picture_url' => $data->profilePicture,
                'external_url' => $data->externalUrl,
                'website_id' => $website_id,
                'media_count' => $data->mediaCount,
                'followers_count' => $data->followers,
                'following_count' => $data->following,
                'avg_likes_count' => $data->avgPostLikes,
                'avg_comments_count' => $data->avgPostComments,
                'avg_dataset_start' => $avg_dataset_start,
                'avg_dataset_end' => $avg_dataset_end,
                'avg_dataset_photos_count' => $data->pictures_count,
                'avg_dataset_videos_count' => $data->videos_count,
                'is_private' => $data->private,
                'is_verified' => $data->verified,
                'user_id' => $user_id,
            ]);
        } else {
            $scraped_data = (object) [
                'instagram_account_id' => $account->id,
                'username' => $data->userName,
                'full_name' => $data->fullName,
                'biography' => $data->biography,
                'profile_picture_url' => $data->profilePicture,
                'external_url' => $data->externalUrl,
                'website_id' => $website_id,
                'media_count' => $data->mediaCount,
                'followers_count' => $data->followers,
                'following_count' => $data->following,
                'avg_likes_count' => $data->avgPostLikes,
                'avg_comments_count' => $data->avgPostComments,
                'avg_dataset_start' => $avg_dataset_start,
                'avg_dataset_end' => $avg_dataset_end,
                'avg_dataset_photos_count' => $data->pictures_count,
                'avg_dataset_videos_count' => $data->videos_count,
                'is_private' => $data->private,
                'is_verified' => $data->verified,
                'user_id' => $user_id,
            ];
        }
        return compact('scraped_data', 'hashtags', 'locations', 'users', 'account', 'medias');
        //return response()->json($data);
    }
}
