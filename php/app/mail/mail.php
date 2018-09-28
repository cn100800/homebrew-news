<?php

namespace app\mail;

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class mail
{
    public function mail($theme, $message, $from = '', $to = '')
    {
        $mail_config = json_decode(file_get_contents(__DIR__.'/../../config/mail.json'), true);
        $transport = (new Swift_SmtpTransport($mail_config['host'], $mail_config['port']))
            ->setUsername($mail_config['username'])
            ->setPassword($mail_config['password'])
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message($theme))
            ->setFrom([$mail_config['send_from'] => 'cn'])
            ->setTo([$mail_config['send_to'], $mail_config['send_to'] => '早上好'])
            ->setBody($message, 'text/html', 'utf-8')
        ;

        // Send the message
        $result = $mailer->send($message);
    }
}
