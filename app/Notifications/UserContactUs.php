<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;


class UserContactUs extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $user     = null;
    protected $name     = null;
    protected $email    = null;
    protected $subject  = null;
    protected $number   = null;
    protected $message  = null;

    public function __construct(User $user,$data)
    { 
       $this->user     = $user;
       $this->name     = $data['name'];
       $this->email    = $data['email'];
       $this->subject  = $data['subject'];
       $this->number   = $data['number'];
       $this->message  = $data['message'];
       // dd($this->message);
     
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
        ->subject('User Contact')
        ->view('system-emails.users.contact-us', 
        [

         'user_name' => $this->user->getUserTitle(),
         'name'      => $this->name,
         'email'     => $this->email,
         'subject'   => $this->subject,
         'user_message'   => $this->message,
         'number'    => $this->number,

        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
