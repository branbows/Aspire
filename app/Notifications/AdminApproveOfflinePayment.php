<?php

namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminApproveOfflinePayment extends Notification
{
    use Queueable;

    protected $user = '';
    protected $plan = '';
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,$plan)
    {
        $this->user = $user;
        $this->plan = $plan;
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
         ->subject('Offline payment approved')
         ->view(
        'system-emails.payments.offline-payment-approved', [

                                                            'username' => $this->user->getUserTitle(),
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
    //         'title' => $this->user->getUserTitle().' Offline Payment Approved',
    //         'description' => 'Your offline payments is approved<br><b>Comments:</b>'.$this->admin_comments,
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
