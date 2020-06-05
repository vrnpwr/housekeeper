<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// class NewMessage extends Notification
class InviteCleaner extends Notification
{
    use Queueable;
    public $details;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
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
        $cleaner_name = $this->details['cleaner_name'];
        $host_name = $this->details['host_name'];
        $property_details = $this->details['property_details'];
        foreach($property_details as $key=>$value){
            if($key==0){           
            $this->details['property_one'] = $value;
            }
            if($key==1){           
                $this->details['property_two'] = $value;
            }
        }
        $property_count = count($this->details['property_details']);
        // dd($property_details);
        return (new MailMessage)  
                    // ->line(foreach($property_details as $key=>$value){echo $value})
                    // *->mailer('postmark')
                    // *->salutation('salu')
                    ->subject($property_count.' new Property Available!')
                    ->greeting('Hello! '. $cleaner_name)
                    ->line('Property Name: '.$this->details['property_one']->property_name)
                    ->line('Property Name: '.$this->details['property_two']->property_name)
                    ->line('Requested by:  '. $cleaner_name)
                    // ->line('You have recieved invitation from Host.')
                    ->action('See all details', url('/'))
                    ->line('Thank you for using our application!');
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
