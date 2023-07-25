<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Storage;

class NewMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;
    protected $channels;
    protected $title;
    protected $body;




    public function __construct($message, $channels)
    {
        $this->message = $message;
        $this->channels = $channels;

    }

    public function via($notifiable)
    {
        return $this->channels;
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => $this->message
        ]);
    }

    public function toArray($notifiable)
    {

        return [
            'message' => $this->message
        ];

    }

    public function toFirebase($notifiable)
    {

        return (new FirebaseMessage)
            ->withTitle($this->title)
            ->withBody($this->body)
            ->withAdditionalData([
                'notification_id' => DatabaseNotification::orderBy('created_at', 'desc')->first()->id,
                'date' => DatabaseNotification::orderBy('created_at', 'desc')->first()->created_at
            ])
            // ->withIcon('https://seeklogo.com/images/F/firebase-logo-402F407EE0-seeklogo.com.png')
            ->withPriority('high')
            // ->withImage('https://italcol.bexdeliveries.com/storage/pU9EQPnoxxSawh1YxB5pRwOTA9Mmjaq4ne5COBOE.png')
            ->withClickAction('export_database_native')
            ->asNotification($notifiable->fcm_token);
    }


}
