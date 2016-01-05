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
        $this->middleware('security');
        //przyda sie do robienia admina - funkcje kasowania userow
        //$this->middleware('auth', ['only' => 'create']);
    }

    public function show() {
        
        return view('user.show');
        
    }
    
    /**
     * Sending user information to the view.
     * @param type $id
     * @return type
     */
    public function edit($id) {
        $user = User::findOrFail($id);
        return view ('user.edit', compact('user'));
    }
    
    public function editPassword($id) {
        $user = User::findOrFail($id);
        return view ('user.passwordchange', compact('user'));
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
        \Session::flash('flash_message', 'Dane zostały zapisane!');
        return redirect('user/edit/'.$id);
    }
    
    public function updatePassword($id, Request $request) {
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();
        \Session::flash('flash_message', 'Hasło zostało zmienione!');
        return redirect('user/edit/'.$id);
    }
    
    public function adminIndex() {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }
    
      public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        \Session::flash('flash_message', 'Użytkownik został usunięty!');
        return redirect('/admin/users');
    }
}
