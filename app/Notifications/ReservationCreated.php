<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reservation;

    public function __construct(Reservation $reservation)
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
            ->subject('Confirmation de votre réservation')
            ->greeting('Bonjour ' . $notifiable->prenom . ',')
            ->line('Votre réservation a bien été enregistrée.')
            ->line('Service : ' . $this->reservation->service->nom_service)
            ->line('Coiffeur : ' . $this->reservation->coiffeur->getNomCompletAttribute())
            ->line('Date et Heure : ' . $this->reservation->date_heure_reservation->format('d/m/Y H:i'))
            ->line('Merci de votre confiance !');
    }
    
}

?>