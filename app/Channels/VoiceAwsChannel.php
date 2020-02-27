<?php

namespace App\Channels;

use AWS;
use Illuminate\Notifications\Notification;

class VoiceAwsChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed                                  $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        //return "Ok";
        $message = $notification->toVoice($notifiable);

//        PhoneLog::create(['phone_id' => $notifiable->primaryPhone->id, 'notes' => 'SMS regarding: '.$message['title'], 'type' => 'OUTBOUND_AUTO_SMS']);

        $client = AWS::createClient('Connect', ['region' => 'eu-central-1']);

        return response()->json([
            'availability' => $client->startOutboundVoiceContact([
                'Attributes' => [
                    'name' => $notifiable->name,
                    'message' => '<speak><break time="1s"/>' . preg_replace("/\r|\n/", '<break time="230ms"/>', $message['message']) . '<break time="1s"/></speak>',
                    'transfer' => $message['transfer'] ?? 'false',
                ],
                //'ClientToken' => '<string>',
                'ContactFlowId' => config('aws.connect.ContactFlowId'), // REQUIRED
                'DestinationPhoneNumber' => $notifiable->primaryPhone->e164, // REQUIRED
                'InstanceId' => config('aws.connect.InstanceId'), // REQUIRED
                'QueueId' => config('aws.connect.QueueId'),
                //'SourcePhoneNumber' => '<string>',
            ]),
        ]);

    }
}
