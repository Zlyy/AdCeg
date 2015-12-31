<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adverts;

class AdvertsController extends Controller
{
    public function index() {
        
        $adverts = Adverts::all();
        return view('adverts.index', compact('adverts'));
    }
    
    
    public function show($id) {
        $advert = Adverts::findOrFail($id);
        return view('adverts.show', compact('advert'));
    }
    
    public function create() {
        return view('adverts/create');
    }
    
    public function store() {
        
    }
    
    
    
    //to delete in future
    public function home() {
        return view('home');
    }
}
