<?php

namespace App;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mailer
{
    public function sendEmail()
    {
        $config = Config::getInstance();
        $config->data['mailer']['host'];
        $transport = (new Swift_SmtpTransport($config->data['mailer']['host'], $config->data['mailer']['port']))
            ->setUsername($config->data['mailer']['username'])
            ->setPassword($config->data['mailer']['password']);
        $mailer = new Swift_Mailer($transport);
        $message = new Swift_Message();
        $message->setSubject('Critical error!');
        $message->setFrom([$config->data['mailer']['host'] => 'Denis Stolyarov']);
        $message->addTo('skstolyarov@mail.ru','333');
        $message->setBody("This is the plain text body of the message.\nThanks,\nAdmin");
        $mailer->send($message);
    }
}
