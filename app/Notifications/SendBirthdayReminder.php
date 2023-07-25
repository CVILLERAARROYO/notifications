<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Carbon\Carbon;
class SendBirthdayReminder extends Notification
{
    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }

    /**
     * Get the firebase representation of the notification.
     */
    public function toFirebase($notifiable)
    {
        $deviceTokens = [
            'fNXM8gi2SVCgDK-3iHvOKa:APA91bE9lL6UNFcnDmCtrif3zSuOZdzaDTWFoSL674ekFyoDS9qAEhWJE9JV13-HEpsn4Vv6uwgKVwRSwK9HzPVbbzVAHL6rmhILPH7SQ1k412rMvQ4qofGYMSGfI-FHlaKYeiet9nqu',
        ];
        
        return (new FirebaseMessage)
            ->withTitle($notifiable->profile_photo_url)
            ->withBody('Mensaje desde el backend! ' . Carbon::now())
            ->asNotification($deviceTokens); // OR ->asMessage($deviceTokens);
    }
}