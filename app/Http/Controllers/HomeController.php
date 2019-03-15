<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ContactMsg;
use App\Mail\ContactMsgEmail;

class HomeController extends Controller
{

    // Return the view
    public function contactForm() {
        return view('contact-form');
    }

    // Handles the ajax request
    public function contactFormRequest(Request $request) {

        // Define validation error messages to be passed back in JSON array
        $errorMsg = [
            'name.required'     => 'name',
            'company.required'  => 'company',
            'email.required'    => 'email',
            'email.email'       => 'email-format',
            'phone.required'    => 'phone',
            'phone.regex'       => 'phone-format',    
            'subject.required'  => 'subject',
            'message.required'  => 'message'
        ];

        // Validating the inputs
        $validator = \Validator::make($request->all(),[
            'name'      => 'required',
            'company'   => 'required',
            'email'     => 'required|email',
            'phone'     => 'required|regex:/[0-9]{9}/',
            'subject'   => 'required',
            'message'   => 'required'
        ], $errorMsg);


        // Check if validator fails, if not insert new contact form message to DB
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            // Insert new contact form message to DB
            $newMsg = new ContactMsg([
                'name'      => $request->name, 
                'company'   => $request->company, 
                'email'     => $request->email, 
                'phone'     => $request->phone, 
                'subject'   => $request->subject,
                'message'   => $request->message
            ]);
            $newMsg->save();

            // // Send email to user
            \Mail::to($request->email)->send(new ContactMsgEmail($newMsg));

            // Return JSON
            return response()->json(['success' => 'Data Sent Successfully!']);
        }
    }
}
