<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TicketNotification extends Notification
{
    use Queueable;

    public $message;
    public $ticketId;

    public function __construct($message, $ticketId)
    {
        $this->message = $message;
        $this->ticketId = $ticketId;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // 🔥 Simpan di database & kirim via real-time broadcast
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'ticket_id' => $this->ticketId
        ];
    }
}
