<?php

namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminCancelledOfflinePayment extends Notification
{
    use Queueable;

    protected $user = '';
    protected $plan = '';
    protected $comments = '';
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,$plan,$comments='')
    {
        $this->user = $user;
        $this->plan = $plan;
        $this->comments = $comments;
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
         ->subject('Offline payment cancelled')
         ->view(
        'system-emails.payments.offline-payment-cancelled', ['username' => $this->user->getUserTitle(),
                                                       'comments'=>$this->comments,
                                                       'plan'=>$this->plan
                                                       ]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'title' => $this->user->getUserTitle().' Offline Payment cancelled',
    //         'description' => 'Your offline payments was cancelled<br><b>Comments:</b>'.$this->comments,
    //         'url' => URL_PAYMENTS_LIST.$this->user->slug,
    //         'image' => null
    //     ];
    // }

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
