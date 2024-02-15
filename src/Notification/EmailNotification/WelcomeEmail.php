<?php
namespace App\Notification\EmailNotification;

use App\Entity\User;
use App\Notification\EmailBuilder;

class WelcomeEmail extends EmailBuilder
{
    public function send(User $user)
    {
        $link = self::APP . $this->urlGenerator->generate('security_confirmAccount', [
            'id' => $user->getId(),
            'token' => $user->getConfirmationToken()
        ]);

        $this->sendEmail(
            $this->createEmail()
            ->from(self::NOREPLY_EMAIL)
            ->to($user->getEmail())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Bienvenue dans la communauté Leboncoin, '. $user->getUsername() .' !')
            ->html($this->twig->render('notification/email/welcomeEmail.html.twig', [
                'user' => $user,
                'link' => $link
            ]))
        );
    }
}