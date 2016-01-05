<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use App\Http\Requests\EditTag;

class TagsController extends Controller {

    public function show(Tag $tag) {
        $adverts = $tag->adverts()->NotExpired()->get();
        return view('adverts.index', compact('adverts'));
    }

    public function adminTags(EditTag $request) {

        $tags = \App\Tag::latest()->get();
        return view('admin.tags', compact('tags'));
    }

    public function destroy($id, EditTag $request) {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        \Session::flash('flash_message', 'Tag został usunięty!');
        return redirect('/admin/tags');
    }

}
