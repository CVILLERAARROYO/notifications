<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\DatabaseNotification;
use Carbon\Carbon;
use Illuminate\Notifications\Messages\FirebaseMessage;
use App\Notifications\SendBirthdayReminder;
use Kutia\Larafirebase\Facades\Larafirebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Messaging\WebPushConfig;
use Kreait\Firebase\Messaging\WebPushNotification;
use Kreait\Firebase\Messaging\FirebaseMessaging;
use App\Events\MyEvent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/test', function () {
    $user = auth()->user();
    return $user->readNotifications;
});


Route::get('/', function () {


   $users = User::all();
    
   $message = Carbon::now();

   $channels = ['database', 'broadcast', 'firebase'];
//    $channels = ['database', 'firebase'];
//    $channels = ['database', 'broadcast'];


    
   Notification::send($users, new NewMessageNotification($message, $channels));

   
   event(new MyEvent($message));




    return Inertia::render('Welcome', [
             'canLogin' => Route::has('login'),
             'canRegister' => Route::has('register'),
             'laravelVersion' => Application::VERSION,
             'phpVersion' => PHP_VERSION,
         ]);


    $users = User::all();
    
    $message = Carbon::now();
    $channels = ['broadcast', 'firebase', 'database'];
    
    return Notification::send($users, new NewMessageNotification($message,$channels));


    $users = User::all();

    return Notification::send($users, new SendBirthdayReminder());



    dd($res);
    $message = Carbon::now();
    $users = User::all();
   return Notification::send($users, new NewMessageNotification($message));
    return response()->json([
        'success' => true,
        'message' => 'Notificación enviada correctamente.',
    ]);
    // $user = Auth::user();
    // $unreadNotifications = $user->unreadNotifications;
    // return $unreadNotifications;
    $users = User::all();
    $message = Carbon::now();
    return Notification::send($users, new NewMessageNotification($message));

    // foreach ($users as $key => $user) {
    // $message = $user->email;
    //     Notification::send($users, new NewMessageNotification($message));
    //     // $user->notify(new NewMessageNotification($message));
    // }
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
