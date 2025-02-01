<?php
namespace App\Controllers;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class MailerController
{
    private $mailer;

    public function __construct()
    {
        $dsn = $_ENV['MAILER_DSN']; // Asegúrate de configurar esto en tu .env
        $transport = Transport::fromDsn($dsn);
        $this->mailer = new Mailer($transport);
    }

    public function sendActivationEmail($recipientEmail, $recipientName, $secureToken)
    {
        $activationLink = "http://www.proyectnavidad.local/index.php?controller=Usuarios&action=activarAction&token=$secureToken";
        
        $email = (new Email())
            ->from('javierrumo2@gmail.com') // Remitente
            ->to($recipientEmail) // Destinatario
            ->subject('Activación de cuenta')
            ->text("Hola $recipientName,\n\nGracias por registrarte. Por favor, haz clic en el siguiente enlace para activar tu cuenta: $activationLink\n\nEste enlace es válido por 24 horas.")
            ->html("<p>Hola $recipientName,</p><p>Gracias por registrarte. Por favor, haz clic en el siguiente enlace para activar tu cuenta:</p><p><a href='$activationLink'>$activationLink</a></p><p>Este enlace es válido por 24 horas.</p>");
        
        $this->mailer->send($email);
    }
}