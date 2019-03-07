<?php

namespace App\Utils;

class Mail
{

    public static function enviarEmail($asunto, $to, $body)
    {
        $mensaje = \Swift_Message::newInstance()
                ->setSubject($asunto)
                ->setFrom([$ENV['MAILER_USER'] => 'Infotaller Team'])
                ->setTo($to)
                ->setBody($body, 'text/html');

        $this->get('mailer')->send($mensaje);
    }

}