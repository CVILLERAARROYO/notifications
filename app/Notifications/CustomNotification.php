use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\FirebaseMessage;

class CustomNotification extends Notification
{
    public function toFirebase($notifiable)
    {
        // Aquí puedes personalizar el contenido de la notificación
        return (new FirebaseMessage())
            ->notification([
                'title' => 'Título de la notificación',
                'body' => 'Contenido de la notificación',
            ])
            ->data([
                // Puedes incluir datos adicionales que se enviarán con la notificación
                'key' => 'value',
            ]);
    }

    //...
}
