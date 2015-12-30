<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdvertController extends Controller
{
    public function __construct()
    {
       
    }
    
     /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {

        return view('home');
    }
    
    
}
