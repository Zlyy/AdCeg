<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
Use App\Http\Controllers\Auth;

class UserController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function show() {
        
        return view('user.show');
        
    }
    
    public function edit($id) {
        
        $user = User::findOrFail($id);
        return view ('user.edit', compact('user'));
    }
    
    
    
    /**
     * Update user information.
     * @param type $id
     * @param Request $request
     */
    public function update($id, Request $request) {
        $user = User::findOrFail($id);
        $user->update($request->all());
        //$user->update(bcrypt($request->password));
        return redirect('user/edit/'.$id);
    }
}
