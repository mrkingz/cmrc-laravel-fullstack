<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountActivation extends Notification
{
    use Queueable;

    /**
     * The token.
     *
     * @var string
     */
    protected $token;

    /**
     * Create a new notification instance.
     *
     * @param string $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello, '.$notifiable->name.'!')
                    ->line(Lang::getFromJson('Click the button below to activate your account.'))
                    ->action(Lang::getFromJson('Activate Account'), url(route('activation', ['token' => $this->token, 'id' => $notifiable->id], false)))
                    ->line(Lang::getFromJson('Thank you for using our application!'));
    }
}
