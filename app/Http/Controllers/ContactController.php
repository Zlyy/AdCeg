<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller {

    public function create() {
        return view('contact.form');
    }

    public function store(ContactFormRequest $request) {
        
        \Mail::raw ('test', function($message) {
                $message->from('test@test.pl');
                $message->to('test@test.com', 'Admin')->subject('TODOParrot Feedback');
                });
        return redirect('/contact')->with('message', 'Twója wiadomość została wysłana!');
    }

}
