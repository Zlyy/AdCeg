<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\ContactAdvertFormRequest;

class ContactController extends Controller {

    public function create() {
        return view('contact.form');
    }

    public function store(ContactFormRequest $request) {

        \Mail::send('contact.email', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message')
                ), function($message) {
            $message->from('server@adceg.dev');
            $message->to('help@adceg.dev', 'Admin')->subject('Formularz kontaktowy');
        });
        return redirect('/')->with('message', 'Twója wiadomość została wysłana!');
    }
    public function advertStore(ContactAdvertFormRequest $request) {
        
        \Mail::send('contact.advertemail', array( 'name' => \Auth::user()->login,
            'email' => \Auth::user()->email,
            'user_message' => $request->get('message')), 
                function($message) {
                    $message->from(\Auth::user()->email);
                    $message->to(\App\User::find(\Request::get('author_id'))->email)->subject('Ogłoszenie - '.\Request::get('title'));
        });
        return \Redirect::back()->with('message', 'Twója wiadomość została wysłana!');
    }

}
