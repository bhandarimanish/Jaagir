<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Profile;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['seeker','verified']);
    }
    public function index()
    {
       
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'address'=>'required',
            'experience'=>'required',
            'jobtitle'=>'required',
            'skill'=>'required|min:20',
            'phone_number'=>'required|min:10',
        ]);
        $user_id=auth()->user()->id;
        Profile::where('user_id',$user_id)->update([
            'address'=>request('address'),
            'phone_number' => request('phone_number'),
            'jobtitle' => request('jobtitle'),
            'experience'=>request('experience'),
            'skill'=>request('skill'),
            'jobtitle'=>request('jobtitle'),
            'jobtype'=>request('jobtype'),
            'category' => request('category'),
            'salary' => request('salary'),
        ]);
        return redirect()->back()->with('message','Profile updated successfully!');
    }

    public function coverletter(Request $request)
    {
        $this->validate($request,[
            'cover_letter'=>'required|mimes:pdf,doc,docx|max:20000'
        ]);
        $user_id=auth()->user()->id;
        $cover=$request->file('cover_letter')->store('public/files');
        Profile::where('user_id',$user_id)->update([
          'cover_letter'=>$cover  
        ]);
        return redirect()->back()->with('message','Coverletter updated successfully!');
    }

    public function resumeletter(Request $request)
    {
        $this->validate($request,[
            'resume'=>'required|mimes:pdf,doc,docx|max:20000'
        ]);
        $user_id=auth()->user()->id;
        $resume=$request->file('resume')->store('public/files');
        Profile::where('user_id',$user_id)->update([
          'resume'=>$resume  
        ]);
        return redirect()->back()->with('message','Resume updated successfully!');
    }

    public function avatar(Request $request)
    {
        $this->validate($request,[
            'avatar'=>'required|mimes:png,jpg,jpeg|max:20000'
        ]);
        $user_id=auth()->user()->id;
        if($request->hasfile('avatar'))
        {
            $file=$request->file('avatar');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('avatar',$filename);
            Profile::where('user_id',$user_id)->update([
                'avatar'=>$filename  
              ]);
              return redirect()->back()->with('message','Profile Picture updated successfully!');
        }
    }
}
