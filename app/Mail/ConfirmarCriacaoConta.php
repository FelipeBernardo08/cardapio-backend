<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmarCriacaoConta extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datas, $subj)
    {
        $this->data = $datas;
        $this->subject = $subj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ConfirmarEmail')
            ->with(['data' => $this->data]);
    }
}
