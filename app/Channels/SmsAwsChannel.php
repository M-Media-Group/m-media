<?php

namespace App\Channels;

use App\PhoneLog;
use AWS;
use Illuminate\Notifications\Notification;

class SmsAwsChannel
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
        $message = $notification->toSms($notifiable);

        $sms = AWS::createClient('pinpoint');

        PhoneLog::create(['phone_id' => $notifiable->primaryPhone->id, 'notes' => 'SMS regarding: '.$message['title'], 'type' => 'OUTBOUND_AUTO_SMS']);

        return $sms->sendMessages([
            'ApplicationId'  => config('aws.pinpoint.app_id'),
            'MessageRequest' => [
                'Addresses' => [
                    $notifiable->primaryPhone->e164 => [
                        'ChannelType' => 'SMS',
                    ],
                ],

                'MessageConfiguration' => [
                    'SMSMessage' => [
                        'Body'        => $message['title']."\n".$message['message'].($message['action_text'] ? "\n\n".$message['action_text'].': '.$message['action'] : null),
                        'MessageType' => $message['type'],
                        'SenderId'    => str_replace(' ', '', config('app.name')),
                    ],
                ],
            ],
        ]);
    }
}
