<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adverts;
use Carbon\Carbon;
use App\Http\Requests\CreateAdvertRequest;

class AdvertsController extends Controller
{
    public function index() {
        
        $adverts = Adverts::latest('created_at')->NotExpired()->get();
        return view('adverts.index', compact('adverts'));
    }
    
    
    public function show($id) {
        $advert = Adverts::findOrFail($id);
        return view('adverts.show', compact('advert'));
    }
    
    public function create() {
        return view('adverts.new');
    }
    

    public function store(CreateAdvertRequest $request) {
      Adverts::create(\Request::all());
      $input['expired_at'] = Carbon::now();
      return redirect('adverts');
    }
    
    public function edit($id) {
        $advert = Adverts::findOrFail($id);
        
        return view('adverts.edit', compact('advert'));
    }
    
    public function update($id, CreateAdvertRequest $request) {
        $advert = Adverts::findOrFail($id);
        $advert->update($request->all());
        return redirect('adverts');
    }
    
    
    
    //to delete in future
    public function home() {
        return view('home');
    }
}
