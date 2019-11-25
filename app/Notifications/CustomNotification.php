<?php

namespace App\Notifications;

use App\Channels\SmsAwsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        $channels = [];
        if (isset($this->data['send_sms'])) {
            if ($notifiable->primaryPhone && mb_strtolower($notifiable->primaryPhone->number_type) == 'mobile') {
                array_push($channels, SmsAwsChannel::class);
            } else {
                $this->data['send_email'] = true;
            }
        }
        if (isset($this->data['send_email'])) {
            array_push($channels, 'mail');
        }
        if (isset($this->data['send_database'])) {
            array_push($channels, 'database');
        }

        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject($this->data['title'])
            ->greeting($this->data['title'])
            ->line($this->data['message'])
            ->action($this->data['action_text'], url($this->data['action']));

        return (new MailMessage())->view(
            'emails.name', ['invoice' => $this->invoice]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title'       => $this->data['title'],
            'message'     => $this->data['message'],
            'action'      => $this->data['action'] ? url($this->data['action']) : null,
            'action_text' => $this->data['action_text'] ?? null,
            'is_custom'   => true,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toSms($notifiable)
    {
        return [
            'title'       => $this->data['title'],
            'message'     => $this->data['message'],
            'action'      => $this->data['action'] ? url($this->data['action']) : null,
            'action_text' => $this->data['action_text'] ?? null,
            'is_custom'   => true,
            'type'        => 'TRANSACTIONAL',
        ];
    }
}
