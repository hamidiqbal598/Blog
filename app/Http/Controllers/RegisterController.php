<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    //
    public function create() {
        return view('register.create');
    }

    public function store() {

//        var_dump(request()->all());
        $attributes = request()->validate([
            'name' => 'required|max:255',
//            'username' => 'required|min:3|max:255|unique:users,username',
            'username' => ['required','min:3','max:255',Rule::unique('users','username')],
            'email' => 'required|min:3|email|max:255',
            'password'=> ['required', 'min:7', 'max:2555'],
        ]);

//        no need as we make mutators for it in user model
//        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        auth()->login($user);

//        session()->flash('success','Your account has been created.');

        return redirect('/')->with('success','Your account has been created.');
    }
}
