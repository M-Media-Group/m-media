<?php

namespace App\Channels;

use AWS;
use Illuminate\Notifications\Notification;

class SmsAwsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        //return "Ok";
        $message = $notification->toSms($notifiable);

        $sms = AWS::createClient('pinpoint');

        return $sms->sendMessages([
            'ApplicationId' => config('aws.pinpoint.app_id'),
            'MessageRequest' => [
                'Addresses' => [
                    $notifiable->primaryPhone->e164 => [
                        'ChannelType' => "SMS",
                    ],
                ],

                'MessageConfiguration' => [
                    'SMSMessage' => [
                        'Body' => $message['title'] . "\n" . $message['message'] . ($message['action_text'] ? "\n\n" . $message['action_text'] . ": " . $message['action'] : null),
                        'MessageType' => $message['type'],
                        'SenderId' => "MMedia",
                    ],
                ],
            ],
        ]);
    }
}
