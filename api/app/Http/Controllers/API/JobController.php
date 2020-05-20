<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use Mail;

class JobController extends Controller
{
    //
    public function processQueue()
    {
        $emailJob = new SendWelcomeEmail();
        dispatch($emailJob);
    }
    public function registerActivation()
    {
        $emailJob = new SendWelcomeEmail();
        dispatch($emailJob);
    }
}
