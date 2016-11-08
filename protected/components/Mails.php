<?php

class Mails
{
    public static function send($to, $subject, $text)
    {
        $sending = false;

        if ($to) {
            $header = "Content-type: text/html; charset=utf-8\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "From: feedback@example.com <feedback@example.com>\r\n";
            $sending = mail($to, $subject, $text, $header);
        }

        return $sending;
    }
}