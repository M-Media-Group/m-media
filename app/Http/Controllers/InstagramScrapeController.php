<?php

namespace App\Http\Controllers;

use App\Bot;
use App\InstagramAccount;
use App\Jobs\ScrapeInstagramAccount;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class InstagramScrapeController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['verified', 'optimizeImages'])->except(['index']);
    }

    public function index(Request $request, $username)
    {
        $scraped_data = InstagramAccount::where('username', $username)->with(['latestScrape', 'scrapes'])->withCount('scrapes')->first();
        if (! isset($scraped_data->latestScrape) || $request->input('force') == true) {
            $data = ScrapeInstagramAccount::dispatchNow($username, $request->user() ?? null, ! $request->input('force'));
            //$data['account']->scrapes_count = 1;
            return redirect('/instagram-accounts/'.$data['account']['id']);
        }

        return redirect('/instagram-accounts/'.$scraped_data->id);
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Bot::class);
        //return SyncBots::dispatchNow();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bot = Bot::where('id', $id)->with('user')->firstOrFail();
        $this->authorize('show', $bot);

        return view('bots.show', ['bot' => $bot]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // PhoneLog::create(['phone_id' => $phone->id, 'type' => 'INBOUND']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $PhoneLog = PhoneLog::findOrFail($id);

        $request->validate([
            'notes' => 'nullable',
            'ended_at' => 'nullable',
        ]);

        //$PhoneLog->update($request->only('notes', 'ended_at'));
        return $PhoneLog;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function connect(Request $request, $id)
    {
        $bot = Bot::findOrFail($id);
        $this->authorize('connectToBot', $bot);

        try {
            $headers = [
                'Content-Type' => 'application/json',
                'AccessToken' => 'key',
                'Authorization' => 'Bearer token',
                'developerkey' => config('blog.remoteit.developerkey'),
            ];
            $client = new Client([
                'headers' => $headers,
            ]);

            $response = $client->request('POST', 'https://api.remot3.it/apv/v27/user/login', [RequestOptions::JSON => [
                'username' => config('blog.remoteit.username'),
                'password' => config('blog.remoteit.password'),
            ]]);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            $obj = json_decode($body);

            //# Get devices
            $headers = [
                'Content-Type' => 'application/json',
                'token' => $obj->token,
                'Authorization' => 'Bearer token',
                'developerkey' => config('blog.remoteit.developerkey'),
            ];
            $client = new Client([
                'headers' => $headers,
            ]);

            $response = $client->request('POST', 'https://api.remot3.it/apv/v27/device/connect', [RequestOptions::JSON => [
                'deviceaddress' => $bot->address,
                'wait' => true,
            ]]);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            $obj = json_decode($body);

            return 'ssh -l pi '.$obj->connection->proxyserver.' -p '.$obj->connection->proxyport;
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
