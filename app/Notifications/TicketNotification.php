<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TicketNotification extends Notification
{
    use Queueable;

    public $message;
    public $ticketId;
    public $title;

    public function __construct($ticket, $customMessage = null)
    {
        $this->ticketId = $ticket->id;
        $this->title = 'Tiket Baru Telah Dibuat';
        $this->message = $customMessage ?? "Tiket #{$ticket->id} dibuat oleh {$ticket->user->name} dengan deskripsi: {$ticket->description}.";
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'ticket_id' => $this->ticketId
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => $this->title,
            'message' => $this->message,
            'ticket_id' => $this->ticketId
        ]);
    }
}
