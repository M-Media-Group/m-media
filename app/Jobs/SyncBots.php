<?php

namespace App\Jobs;

use App\Bot;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncBots implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
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
                "username" => config('blog.remoteit.username'),
                "password" => config('blog.remoteit.password'),
            ]]);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            $obj = json_decode($body);

            ## Get devices
            $headers = [
                'Content-Type' => 'application/json',
                'token' => $obj->token,
                'Authorization' => 'Bearer token',
                'developerkey' => config('blog.remoteit.developerkey'),
            ];
            $client = new Client([
                'headers' => $headers,
            ]);

            $response = $client->request('GET', 'https://api.remot3.it/apv/v27/device/list/all');
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            $obj = json_decode($body);

            foreach ($obj->devices as $device) {
                $country = Bot::updateOrCreate(
                    ['address' => $device->deviceaddress],
                    [
                        'alias' => $device->devicealias,
                        'last_ip' => $device->devicelastip,
                        'last_internal_ip' => $device->lastinternalip,
                        'service_title' => $device->servicetitle,
                        'georegion' => $device->georegion,
                        'type' => $device->devicetype,
                        'is_active' => $device->devicestate == 'active' ? 1 : 0,
                        'last_contact_at' => date("Y-m-d H:i:s", strtotime($device->lastcontacted)),
                    ]
                );
            }
            return $body;
        } catch (Exception $e) {
            return $e;
        }
    }
}
