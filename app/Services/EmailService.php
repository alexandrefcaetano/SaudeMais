<?php

namespace App\Services;

use App\Mail\GenericMail;
use App\Mail\MailController;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * Envia um e-mail genérico.
     *
     * @param  string  $to          O endereço de e-mail do destinatário.
     * @param  string  $subject     O assunto do e-mail.
     * @param  string  $view        A view do e-mail a ser usada.
     * @param  array   $data        Os dados a serem passados para a view.
     * @return void
     */
    public function sendEmail($to, $subject, $view, $data = [])
    {

        Mail::to($to)->send(new MailController($subject, $view, $data));
    }
}
