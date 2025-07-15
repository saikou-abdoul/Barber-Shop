<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationMade extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle réservation reçue')
            ->greeting('Bonjour ' . $notifiable->prenom)
            ->line('Vous avez reçu une nouvelle réservation de la part de ' . $this->reservation->client->prenom . ' ' . $this->reservation->client->nom)
            ->line('Service : ' . $this->reservation->service->nom_service)
            ->line('Date & Heure : ' . $this->reservation->date_heure_reservation->format('d/m/Y H:i'))
            ->action('Voir la réservation', url('/reservations/' . $this->reservation->id_reservation))
            ->line('Merci de votre collaboration.');
    }
}

?>