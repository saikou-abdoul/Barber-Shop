<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CoiffeurReservationReceived  extends Notification implements ShouldQueue
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
    $message = new MailMessage;

    if ($notifiable->isCoiffeur()) {
        return $message
            ->subject('Nouvelle réservation reçue')
            ->greeting('Bonjour ' . $notifiable->prenom . ',')
            ->line('Vous avez reçu une nouvelle réservation.')
            ->line('Client : ' . $this->reservation->client->getNomCompletAttribute())
            ->line('Service : ' . $this->reservation->service->nom_service)
            ->line('Date & Heure : ' . $this->reservation->date_heure_reservation->format('d/m/Y H:i'));
    }

    return $message
        ->subject('Confirmation de votre réservation')
        ->greeting('Bonjour ' . $notifiable->prenom . ',')
        ->line('Votre réservation a été enregistrée.')
        ->line('Service : ' . $this->reservation->service->nom_service)
        ->line('Coiffeur : ' . $this->reservation->coiffeur->getNomCompletAttribute())
        ->line('Date & Heure : ' . $this->reservation->date_heure_reservation->format('d/m/Y H:i'));
}







    
    
    
}

?>