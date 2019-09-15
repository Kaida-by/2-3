<?php

namespace App;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mailer
{
    protected $config;

    protected $mailer;

    public function __construct()
    {
        $this->config = Config::getInstance();
        $transport = (new Swift_SmtpTransport($this->config->data['mailer']['host'], $this->config->data['mailer']['port']))
            ->setUsername($this->config->data['mailer']['username'])
            ->setPassword($this->config->data['mailer']['password']);
        $this->mailer = new Swift_Mailer($transport);
    }

    public function sendEmail($subject, $to, $body)
    {
        $message = new Swift_Message();
        $message->setSubject($subject);
        $message->setFrom([$this->config->data['mailer']['host'] => 'Denis Stolyarov']);
        $message->addTo($to,'333');
        $message->setBody($body);
        $this->mailer->send($message);
    }
}
