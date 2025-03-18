<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('mail:send {user} {text}', function (string $user, string $text) {
    $this->info("Enviando correo a: {$user} ...");

    try {
        // Enviar el correo con el destinatario definido por el primer parámetro ($user)
        Mail::raw($text, function ($message) use ($user) {
            // El destinatario será el primer parámetro
            $message->to($user)  // Aquí es donde se especifica al destinatario
                    ->subject('Correo desde Laravel')  // Asunto
                    ->from(config('mail.from.address'), config('mail.from.name'));  // Remitente, estático desde el .env
        });

        $this->info("Correo enviado a: {$user}");
    } catch (\Exception $e) {
        $this->error("Error al enviar el correo: " . $e->getMessage());
    }
});