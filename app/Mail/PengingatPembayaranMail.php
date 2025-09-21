<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PengingatPembayaranMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Buat mailer dengan data transaksi
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Bangun email
     */
    public function build()
    {
        return $this->subject('Pengingat Pembayaran')
                    ->view('emails.pengingat')
                    ->with('data', $this->data);
    }
}
