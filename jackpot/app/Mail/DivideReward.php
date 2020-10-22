<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DivideReward extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data=$this->data;
        $html = setting('mail_html')->value;
        $html = str_replace("@TICKET_ID@",$data['TICKET_ID'],$html);
        $html = str_replace("@AMOUNT@",$data['AMOUNT'],$html);
        $html = str_replace("@GAME_NAME@",$data['GAME_NAME'],$html);
        $html = str_replace("@PRICE@",$data['PRICE'],$html);
        $html = str_replace("@QUALITY@",$data['QUALITY'],$html);
        $html = str_replace("@TICKET@",$data['TICKET'],$html);
        $html = str_replace("@CUSTOMERNAME@",$data['CUSTOMERNAME'],$html);
        $html = str_replace("@EMAIL@",$data['EMAIL'],$html);
        $html = str_replace("@PHONE@",$data['PHONE'],$html);
        return $this->view('client.mail.mail', ['html' => $html])->subject("DIVIDE REWARD LOTTERY");
    }
}
