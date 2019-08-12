<?php

namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserOfflinePaymentSubmit extends Notification
{
    use Queueable;

    protected $user = '';
    protected $paid_user = '';
    protected $item = '';
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,$paid_user,$item)
    {
        $this->user = $user;
        $this->paid_user = $paid_user;
        $this->item = $item;
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
         ->subject('Offline payment submitted')
         ->view(
        'system-emails.payments.offline-payment-submitted', ['username' => $this->user->getUserTitle(),
                                                             'name'=>$this->paid_user->getUserTitle(),
                                                             'item_name'=>ucfirst($this->item->title)
                         ]);

    }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return array
    //  */
    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'title' => $this->paid_user->getUserTitle().' Offline Payment Submitted',
    //         'description' => 'Please update the offline payment status',
    //         'url' => URL_OFFLINE_PAYMENT_REPORT_DETAILS."pending",
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
