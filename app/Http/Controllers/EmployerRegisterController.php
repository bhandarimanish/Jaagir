<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class EmployerRegisterController extends Controller
{
    public function employerRegister(Request $request)
    {
        $this->validate($request,[
            'cname'=>'required|string|max:60',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8|confirmed'
        ]);
        $user =  User::create([
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'user_type' => request('user_type'),
        ]);

        $user->sendEmailVerificationNotification();
        Company::create([
                'user_id' => $user->id,
                'cname' => request('cname'),
                'slug'=>Str::slug(request('cname')),
            ]);
        return redirect()->back()->with('message','Please verify your email by clicking the link send to your email address and process login...');
    }
}
