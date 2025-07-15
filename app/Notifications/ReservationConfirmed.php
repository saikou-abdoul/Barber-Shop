<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationConfirmed extends Notification
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
            ->subject('Votre réservation a été confirmée')
            ->greeting('Bonjour ' . $notifiable->prenom)
            ->line('Votre réservation pour le service : **' . $this->reservation->service->nom_service . '** a été confirmée.')
            ->line('Date : ' . $this->reservation->date_heure_reservation->format('d/m/Y H:i'))
            ->line('Coiffeur : ' . $this->reservation->coiffeur->prenom . ' ' . $this->reservation->coiffeur->nom)
            ->action('Voir la réservation', url('/reservations/' . $this->reservation->id_reservation))
            ->line('Merci d’avoir choisi notre salon !');
    }
}

?>