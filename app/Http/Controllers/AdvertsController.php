<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adverts;
use Carbon\Carbon;
use App\Http\Requests\CreateAdvertRequest;
use App\Http\Requests\EditAdvertRequest;
use App\Http\Requests\DeleteAdvertRequest;
use App\Tag;

class AdvertsController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['except' => array('index', 'show', 'home', 'searchAdverts')]);
        //$this->middleware('security', ['except' => ['index', 'show', 'home']]);
        //$this->middleware('adsecurity');
    }

    public function index() {
        $adverts = Adverts::latest('created_at')->NotExpired()->paginate(4);
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


        $advert = \Auth::user()->adverts()->create($request->all());


        if ($request->file('image')) {
            $imageName = $advert->id . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/public/images/', $imageName);
            $advert->image = '/public/images/' . $imageName;
            $advert->update();
        }

        if ($request->input('tags_list')) {
            $tags = $request->input('tags_list');
            $currentTags = array_filter($tags, 'is_numeric');
            $newTags = array_diff($tags, $currentTags);
            foreach ($newTags as $newTag) {
                if ($tag = Tag::create(['name' => $newTag])) {
                    $currentTags[] = $tag->id;
                }
            }
            $advert->tags()->sync($currentTags);
            \Session::flash('flash_message', 'Twoje ogłoszenie zostało dodane!');
            return redirect('adverts');
        }
    }

    public function edit($id, EditAdvertRequest $request) {
        $advert = Adverts::findOrFail($id);
        $tags = \App\Tag::lists('name', 'id');
        return view('adverts.edit', compact('advert', 'tags'));
    }

    public function update($id, CreateAdvertRequest $request) {

        $advert = Adverts::findOrFail($id);
        $hasImg = $advert->image;


        $advert->update($request->all());
        if ($request->file('image')) {
            $imageName = $advert->id . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/public/images/', $imageName);
            $advert->image = '/public/images/' . $imageName;
            $advert->update();
        }

        if ($hasImg) {
            $advert->image = $hasImg;
            $advert->update();
        }

        if ($request->input('tags_list')) {
            $tags = $request->input('tags_list');
            $currentTags = array_filter($tags, 'is_numeric');
            $newTags = array_diff($tags, $currentTags);
            foreach ($newTags as $newTag) {
                if ($tag = Tag::create(['name' => $newTag])) {
                    $currentTags[] = $tag->id;
                }
            }
            $advert->tags()->sync($currentTags);
        } else {
            $advert->tags()->delete();
        }


        \Session::flash('flash_message', 'Twoje ogłoszenie zostało zapisane!');
        return redirect('adverts');
    }

    public function owned() {
        $adverts = Adverts::latest('created_at')->where('user_id', app('auth')->user()->id)->NotExpired()->get();
        $advertsExpired = Adverts::latest('created_at')->where('user_id', app('auth')->user()->id)->Expired()->get();
        $activeAdsSum = $this->countActiveAds();
        $expiredAdsSum = $this->countExpiredAds();
        return view('adverts.owned', compact('adverts', 'advertsExpired', 'activeAdsSum', 'expiredAdsSum'));
    }

    public function destroy($id, DeleteAdvertRequest $request) {
        $advert = Adverts::findOrFail($id);
        $advert->delete();
        \Session::flash('flash_message', 'Ogłoszenie zostało usunięte!');
        return redirect('/admin/adverts');
    }

    public function countActiveAds() {
        return Adverts::latest('created_at')->where('user_id', app('auth')->user()->id)->NotExpired()->count();
    }

    public function countExpiredAds() {
        return Adverts::latest('created_at')->where('user_id', app('auth')->user()->id)->Expired()->count();
    }

    public function showUsersAds($id) {
        $adverts = Adverts::latest('created_at')->where('user_id', $id)->NotExpired()->get();
        $advertsExpired = Adverts::latest('created_at')->where('user_id', $id)->Expired()->get();
        $activeAdsSum = $this->CountAdminAds();
        $expiredAdsSum = $this->CountAdminAds();
        return view('adverts.owned', compact('adverts', 'advertsExpired', 'activeAdsSum', 'expiredAdsSum'));
    }

    public function CountAdminAds() {
        return Adverts::latest()->count();
    }

    public function adminAdverts() {
        $adverts = Adverts::latest('created_at')->NotExpired()->get();
        $advertsExpired = Adverts::latest('created_at')->Expired()->get();
        $activeAdsSum = $this->CountAdminAds();
        $expiredAdsSum = $this->CountAdminAds();
        return view('adverts.owned', compact('adverts', 'advertsExpired', 'activeAdsSum', 'expiredAdsSum'));
    }

    public function searchAdverts(Request $request) {

        $input = $request->input('search');
        $searchTerms = explode(' ', $input);

        foreach ($searchTerms as $term) {
            $query = Adverts::join('adverts_tag', 'adverts.id', '=', 'adverts_tag.adverts_id')
                    ->join('tags', 'tags.id', '=', 'adverts_tag.tag_id')
                    ->where('adverts.title', 'LIKE', '%' . $term . '%')
                    ->orWhere('content', 'LIKE', '%' . $term . '%')
                    ->orWhere('tags.name', 'like', '%' . $term . '%')
                    ->with('tags')
                    ->distinct()
                    ->orderBy('created_at', 'DESC');
        }
        $adverts = $query->notExpired()->get(['adverts.*']);
        
        $tags = $this->searchByTags($searchTerms);
        return view('adverts.searchindex', compact('adverts', 'input', array('tags')));
    }

    private function searchByTags($searchTerms) {
        foreach ($searchTerms as $term) {
            $query = Tag::latest()->where('name', 'LIKE', '%' . $term . '%');
        }

        return $query->get();
    }

    public function setExpired($id) {
        $advert = Adverts::findOrFail($id);
        $now = Carbon::now()->subDay(); //nie bangla :(
        //return dd($now->subMinutes(5)->format('Y-m-d'));
        $advert->expired_at = $now->format('Y-m-d');
        $advert->update();
        \Session::flash('flash_message', 'Ogłoszenie zostało oznaczone jako nieaktywne!');
        return redirect('/adverts/owned');
    }

    public function setAvailable($id) {
        $advert = Adverts::findOrFail($id);
        $advert->expired_at = Carbon::now()->addDays(7)->format('Y-m-d');
        $advert->update();
        \Session::flash('flash_message', 'Ogłoszenie zostało oznaczone jako aktywne!');
        return redirect('/adverts/owned');
    }

    //to delete in future
    public function home() {
        return view('home');
    }

}
