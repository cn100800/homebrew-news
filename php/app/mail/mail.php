<?php

namespace app\mail;

class mail {

    public function mail($from, $to, $theme, $message){
        $mail_config = json_decode(file_get_contents(__DIR__.'/../config/mail.json'), true);
        $transport = (new Swift_SmtpTransport($mail_config['host'], $mail_config['port']))
            ->setUsername($mail_config['username'])
            ->setPassword($mail_config['password'])
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom([$mail_config['send_from'] => 'John Doe'])
            ->setTo([$mail_config['send_to'], $mail_config['send_to'] => 'A name'])
            ->setBody('Here is the message itself')
        ;

        // Send the message
        $result = $mailer->send($message);
    }
}
