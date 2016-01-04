<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adverts;
use Carbon\Carbon;
use App\Http\Requests\CreateAdvertRequest;
use App\Http\Requests\EditAdvertRequest;
use App\Tag;


class AdvertsController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show', 'home']]);
        //$this->middleware('security', ['except' => ['index', 'show', 'home']]);
        //$this->middleware('adsecurity');
    }
    
    
    public function index() {
        $adverts = Adverts::latest('created_at')->NotExpired()->get();
        return view('adverts.index', compact('adverts'));
    }
    
    
    public function show($id) {
        $advert = Adverts::findOrFail($id);
        return view('adverts.show', compact('advert'));
    }
    
    public function create() {
        $tags = \App\Tag::lists('name', 'id');
        return view('adverts.new', compact('tags'));
    }
    

    public function store(CreateAdvertRequest $request) {
        
//        $advert = new Adverts($request->all());
//        \Auth::user()->adverts()->save($advert);
        
        $advert = \Auth::user()->adverts()->create($request->all());
        
        
        $tags = $request->input('tags_list');
        $currentTags = array_filter($tags, 'is_numeric');
        $newTags = array_diff($tags, $currentTags);
        
        foreach($newTags as $newTag) {
            if ($tag = Tag::create(['name' => $newTag])) {
                    $currentTags[] = $tag->id;
            }
        }
        $advert->tags()->sync($currentTags);
        
        return redirect('adverts');
    }
    
    public function edit($id, EditAdvertRequest $request ) {
        $advert = Adverts::findOrFail($id);
        $tags = \App\Tag::lists('name', 'id');
        return view('adverts.edit', compact('advert', 'tags'));
    }
    
    public function update($id, CreateAdvertRequest $request) {
        $advert = Adverts::findOrFail($id);
        $advert->update($request->all());
        
         $tags = $request->input('tags_list');
        $currentTags = array_filter($tags, 'is_numeric');
        $newTags = array_diff($tags, $currentTags);
        foreach($newTags as $newTag) {
            if ($tag = Tag::create(['name' => $newTag])) {
                    $currentTags[] = $tag->id;
            }
            
        }
        
        $advert->tags()->sync($currentTags);
        return redirect('adverts');
    }
    
    public function owned() {
        $adverts = Adverts::latest('created_at')->where('user_id', app('auth')->user()->id)->NotExpired()->get();
        $advertsExpired = Adverts::latest('created_at')->where('user_id', app('auth')->user()->id)->Expired()->get();
        $activeAdsSum = $this->countActiveAds();
        $expiredAdsSum = $this->countExpiredAds();
        return view('adverts.owned', compact('adverts', 'advertsExpired', 'activeAdsSum', 'expiredAdsSum'));
    }
    
    public function destroy($id) {
        $advert = Adverts::findOrFail($id);
        $advert->delete();
        return redirect('/adverts/owned');
    }
    
    public function countActiveAds(){
        return Adverts::latest('created_at')->where('user_id', app('auth')->user()->id)->NotExpired()->count();
    }
    
    public function countExpiredAds(){
        return Adverts::latest('created_at')->where('user_id', app('auth')->user()->id)->Expired()->count();
    }





    //to delete in future
    public function home() {
        return view('home');
    }
}
