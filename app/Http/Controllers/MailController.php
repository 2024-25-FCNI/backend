<?php

namespace App\Http\Controllers;

 use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{
    public function sendTestMail()
    {
        $mailData = [
            'title' => 'Értesítés a rendszerből',
            'body' => 'Ez egy automatikus email küldés tesztelése.'
        ];

        Mail::to('teszt@example.com')->send(new DemoMail($mailData));

        return response()->json(['message' => 'Email elküldve sikeresen.']);
    }
} 
/* use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{

public function index()
   {
       $mailData = [
           'title' => 'Mail from your_email.com',
           'body' => 'This is for testing email using smtp.'
       ];       
       Mail::to('your_email@gmail.com')

->send(new DemoMail($mailData));

       dd("Email is sent successfully.");
   }

} */