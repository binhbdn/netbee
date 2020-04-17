<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Sendmail_join extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        return $this->view('mail.sendemail_join',['data'=>$this->data, 'detail_user_add'=>$this->data->detail_user_add, 'id_company'=>$this->data->id_company])->subject($this->data->title);
    }
}
