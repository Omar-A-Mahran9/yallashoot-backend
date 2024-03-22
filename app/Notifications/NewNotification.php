<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNotification extends Notification
{
    use Queueable;

    public $titleAr;
    public $titleEn;
    public $descriptionAr;
    public $descriptionEn;
    public $date;
    public $icon;
    public $color;
    public $url;

    public function __construct($titleAr, $titleEn, $descriptionAr, $descriptionEn, $date, $icon, $color, $url)
    {
        $this->titleAr = $titleAr;
        $this->titleEn = $titleEn;
        $this->descriptionAr = $descriptionAr;
        $this->descriptionEn = $descriptionEn;
        $this->date = $date;
        $this->icon = $icon;
        $this->color = $color;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
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
            'title_ar' => $this->titleAr,
            'title_en' => $this->titleEn,
            'description_ar' => $this->descriptionAr,
            'description_en' => $this->descriptionEn,
            'date' => $this->date,
            'icon' => $this->icon,
            'color' => $this->color,
            'url' => $this->url,
        ];
    }
}
