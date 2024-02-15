<?php 
namespace App\Notification;

use App\Config\Config;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class EmailBuilder
{
    private Mailer $mailer;

    protected Environment $twig;

    protected UrlGeneratorInterface $urlGenerator;

    protected const APP = 'http://localhost:8000';

    protected const CONTACT_EMAIL = 'contact@leboncoin.fr';
    
    protected const NOREPLY_EMAIL = 'noreply@leboncoin.fr';

    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
        $transport = Transport::fromDsn(Config::SMTP);
        $this->mailer = new Mailer($transport);
    }

    protected function createEmail():Email
    {
        return new Email();
    }

    protected function sendEmail(Email $email)
    {
        $this->mailer->send($email);
    }
}