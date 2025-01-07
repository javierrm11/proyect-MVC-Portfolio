<?php
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class MailerService
{
    private $mailer;

    public function __construct()
    {
        $dsn = $_ENV['MAILER_DSN']; // Desde el archivo .env
        $transport = Transport::fromDsn($dsn);
        $this->mailer = new Mailer($transport);
    }

    public function sendActivationEmail($recipientEmail, $activationLink)
    {
        $email = (new Email())
            ->from('your_email@gmail.com') // Correo del remitente
            ->to($recipientEmail) // Correo del destinatario
            ->subject('Activación de tu cuenta')
            ->text("Haz clic en el siguiente enlace para activar tu cuenta: $activationLink")
            ->html("<p>Haz clic en el siguiente enlace para activar tu cuenta:</p><a href='$activationLink'>$activationLink</a>");

        $this->mailer->send($email);
    }
}
