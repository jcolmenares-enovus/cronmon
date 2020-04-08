<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Cronjob;
use Illuminate\Notifications\Messages\SlackMessage;

class JobHasGoneAwol extends Notification
{
    use Queueable;

    public $job;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Cronjob $job)
    {
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'slack'];
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
            ->subject(config('cronmon.email_prefix') . ' Job has not run')
            ->line('Cron job "' . $this->job->name . '" has not run')
            ->action('Check the status', route('job.show', $this->job->id))
            ->line('Job : ' . $this->job->name)
            ->line('Last Run : ' . $this->job->getLastRun() . ' (' . $this->job->getLastRunDiff() . ')')
            ->line('Schedule : ' . $this->job->getSchedule());
    }

    public function toSlack($notifiable)
    {
        $message = "Famous Hello World!";
        
        return (new SlackMessage)
                ->from('Ghost', ':ghost:')
                ->to('#channel-name')
                ->content('Cron job "' . $this->job->name . '" has not run, check the status in ' . route('job.show', $this->job->id));
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
