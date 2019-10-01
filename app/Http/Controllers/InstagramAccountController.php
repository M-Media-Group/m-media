<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFile;
use App\InstagramAccount;
use App\Jobs\PostToBuffer;
use App\Jobs\UploadFile;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class InstagramAccountController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $bot = Bot::findOrFail($id);
        $this->authorize('index', InstagramAccount::class);

        $accounts = InstagramAccount::with('latestScrape', 'user')->get();
        return view('instagramAccounts.index', compact('accounts'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function syncWithBuffer()
    {

        // $bot = Bot::findOrFail($id);
        $this->authorize('index', InstagramAccount::class);
        try {

            $client = new Client();

            $response = $client->request('GET', 'https://api.bufferapp.com/1/profiles.json?access_token=' . config('blog.buffer.access_token'));
            $statusCode = $response->getStatusCode();
            $data = $response->getBody()->getContents();

            $obj = json_decode($data);
            $instagram_accounts = [];
            foreach ($obj as $profile) {
                if ($profile->service == 'instagram') {
                    $account = InstagramAccount::updateOrCreate(
                        ['username' => $profile->service_username],
                        ['buffer_id' => $profile->id]
                    );
                    $profile->m_media_id = $account->id;
                    $profile->is_scrapeable = $account->is_scrapeable;
                    $profile->m_media_user_id = $account->m_media_user_id;
                    $profile->instagram_id = $account->instagram_id;
                    array_push($instagram_accounts, $profile);
                }
            }
            return $instagram_accounts;
        } catch (Exception $e) {
            return $e;
        }

        return InstagramAccount::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPost()
    {
        return view('instagramAccounts.createPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage for File model and post to Buffer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePost(StoreFile $request, InstagramAccount $instagramAccount)
    {
        if (!$instagramAccount->buffer_id || !($request->user()->id == $instagramAccount->user_id || $request->user()->id == config('blog.super_admin_id'))) {
            return "false";
        }

        //return dump();
        $file = UploadFile::dispatchNow($request);

        PostToBuffer::dispatchNow($file, $instagramAccount);

        return back()->with('success', 'We have scheduled your picture to be posted to your Instagram account!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InstagramAccount  $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, InstagramAccount $instagramAccount)
    {
        $scraped_data = $instagramAccount->load(['latestScrape', 'scrapes']);
        $scraped_data->scrapes_count = count($scraped_data->scrapes);
        $buffer_data = null;
        if ($scraped_data->buffer_id && $request->user()) {
            $buffer_data = $scraped_data->bufferProfile();
        }
        $data = ['scraped_data' => $scraped_data->latestScrape, 'account' => $scraped_data, 'buffer' => $buffer_data];

        return view('instagramAccounts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstagramAccount  $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(InstagramAccount $instagramAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InstagramAccount  $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstagramAccount $instagramAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InstagramAccount  $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstagramAccount $instagramAccount)
    {
        //
    }
}
