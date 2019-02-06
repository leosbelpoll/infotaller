<?php

namespace App\Utils;

class Mail
{

    public static function enviarEmail($asunto, $to, $body)
    {
        // $mensaje = (new \Swift_Message($asunto))
        //     ->setFrom([$ENV['MAILER_USER'] => 'Despiece App'])
        //     ->setTo($to)
        //     ->setBody($body, 'text/html');

        // $mailer->send($message);




        $mensaje = \Swift_Message::newInstance()
                ->setSubject($asunto)
                ->setFrom([$ENV['MAILER_USER'] => 'Despiece App'])
                ->setTo($to)
                ->setBody($body, 'text/html');

        $this->get('mailer')->send($mensaje);
    }

}