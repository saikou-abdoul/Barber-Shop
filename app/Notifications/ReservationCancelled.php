<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationCancelled extends Notification
{
    use Queueable;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail']; // Tu peux aussi ajouter 'database' si tu veux stocker les notifications
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Réservation annulée')
            ->greeting('Bonjour ' . $notifiable->prenom)
            ->line('Une réservation prévue le ' . $this->reservation->date_heure_reservation->format('d/m/Y H:i') . ' a été annulée par le client.')
            ->line('Service : ' . $this->reservation->service->nom_service)
            ->action('Voir la réservation', route('reservations.show', $this->reservation))
            ->line('Merci d’utiliser notre plateforme.');
    }
}
