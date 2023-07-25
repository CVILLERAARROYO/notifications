<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;

    protected $channel;
    protected $users;

    /**
     * Create a new notification instance.
     *
     * @param string $channel
     * @param array $users
     * @return void
     */
    public function __construct($channel, $users)
    {
        $this->channel = $channel;
        $this->users = $users;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [$this->channel];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'Hola'
        ]);
    }
}
