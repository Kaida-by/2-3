<?php

namespace App;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mailer
{
    protected $config;

    protected $mailer;

    protected static $instance;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function sendEmail($subject, $to, $body)
    {
        $message = new Swift_Message();
        $message->setSubject($subject);
        $message->setFrom([$this->config->data['mailer']['host'] => $this->config->data['mailer']['from']]);
        $message->addTo($to,$this->config->data['mailer']['to']);
        $message->setBody($body);
        $this->mailer->send($message);
    }

    protected function __construct()
    {
        $this->config = Config::getInstance();
        $transport = (new Swift_SmtpTransport($this->config->data['mailer']['host'],
            $this->config->data['mailer']['port'])
        )
            ->setUsername($this->config->data['mailer']['username'])
            ->setPassword($this->config->data['mailer']['password']);
        $this->mailer = new Swift_Mailer($transport);
    }

    protected function __clone()
    {
    }
}
