<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendTestEmail;
use App\Mail\ContactSendMail;

class ContactController extends Controller
{
    public function createContact(Request $request)
    {   

        $token = $request->input('g-recaptcha-response');
        
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->subject = $request->subject;
        $contact->save();
        

        return response()->json($contact);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('6LdKrcspAAAAAEOyzQHRBBv9EzGJNnhnbPcg3a10'),
            'response' => $token,
        ]);
        return response()->json($contact);
    }

    // public function sendMail(Request $request)
    // {
       
    //     $token = $request->input('g-recaptcha-response');
    
    //     $contact = new Contact();
    //     $contact->name = $request->name;
    //     $contact->email = $request->email;
    //     $contact->message = $request->message;
    //     $contact->subject = $request->subject;
    //     $contact->save();
        
        
    //     $mailData = [
    //         'name' => $contact->name,
    //         'email' => $contact->email,
    //         'message' => $contact->message,
    //         'subject' => $contact->subject,
    //     ];
    
    //     Mail::to('nishatirole28@gmail.com')->send(new sendTestEmail($mailData));
    
    //     return response()->json(['message'=>"Contact Mail Send Succesfully.",'contact'=>$contact],200);
    // }

    public function contactSendMail(Request $request)
    {
        $token = $request->input('g-recaptcha-response');
    
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->subject = $request->subject;
        $contact->save();

        $link = url('/');
        $data = [
            'name' => $contact->name,
            'email' => $contact->email,
            'message' => $contact->message,
            'subject' => $contact->subject,
            'link' => $link,
        ];

        Mail::to('nishatirole28@gmail.com')->send(new ContactSendMail($data));

        return "Email has been sent!";
    }

    }