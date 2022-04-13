<?php

namespace App\Listeners;

use App\Events\FriendRegistered;
use App\Mail\SenderMail;
use Illuminate\Support\Facades\Mail;
use Exception;

class SendEmailNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\FriendRegistered  $event
     * @return void
     */
    public function handle(FriendRegistered $event)
    {
        try {
            Mail::to($event->data->get('friend_email'))
                ->send(new SenderMail($event->data));
        } catch (Exception $exception ) {
            throw new Exception('Cannot send email');
        }
    }
}
