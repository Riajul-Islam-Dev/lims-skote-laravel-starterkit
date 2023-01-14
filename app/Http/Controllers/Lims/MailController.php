<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MailNotification;
use Mail;

class MailController extends Controller
{
    public function index()
    {
        $data = [
            'subject'=>'Test mail subject',
            'body'=>'Test mail body!'
        ];
        try{
            Mail::to('ritewu2014@gmail.com')->send(new MailNotification($data));
            return response()->json(['Email Sent! Check you inbox!']);
        } catch(Exception $th){
            return response()->json(['Email not Sent!']);
            //throw $th;
        }
    }
}
