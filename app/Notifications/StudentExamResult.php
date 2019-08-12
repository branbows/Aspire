<?php

namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StudentExamResult extends Notification
{
    use Queueable;

    protected $user = '';
    protected $staus = '';
    protected $exam_name = '';
    protected $percentage = '';
    protected $test_date = '';
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,$staus, $exam_name,$percentage)
    {
        $this->user = $user;
        $this->staus = $staus;
        $this->exam_name = $exam_name;
        $this->percentage = $percentage;
        $this->test_date = date('Y-m-d');
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
         ->subject('Exam Result')
         ->view(
        'system-emails.users.exam-result', [   'username'   => $this->user->getUserTitle(),
                                                    'staus'    =>$this->staus,
                                                    'exam_name'=>$this->exam_name,
                                                    'percentage'=>$this->percentage,
                                                    'test_date'=>$this->test_date
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
