<?php

namespace App\Http\Controllers;

use App\InstagramAccount;
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
        $this->middleware('verified');
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
     * Display the specified resource.
     *
     * @param  \App\InstagramAccount  $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function show(InstagramAccount $instagramAccount)
    {
        //
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
