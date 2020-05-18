<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    private $code;





    public function __construct($code)
    {
       $this->code =$code;
    }




    public function build()
    {
        return $this->markdown('emails.auth.reset',['code'=>$this->code]);
    }
}
