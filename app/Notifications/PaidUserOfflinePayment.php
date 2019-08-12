<?php

namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaidUserOfflinePayment extends Notification
{
    use Queueable;

    protected $user = '';
    protected $item = '';
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,$item)
    {
        $this->user = $user;
        $this->item = $item;
        // $this->atp_user = $atp_user;
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
        'system-emails.payments.user-offline-payment', [
                                                          'username' => $this->user->getUserTitle(),
                                                          'item_name' => $this->item->title

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
    //         'title' => $this->user->getUserTitle().' Offline Payment Submitted',
    //         'description' => 'Your offline payment was successfully submitted to admin',
    //          'url' => URL_PAYMENTS_LIST.$this->user->slug,
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
