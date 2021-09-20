<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['employer','verified'], ['except' => array('index','company')]);
    }
    
    public function index($id, Company $company)
    {
        return view('company.index',compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'address'=>'required',
            'website'=>'required',
            'slogan'=>'required',
            'phone'=>'required|min:10|numeric',
            'description'=>'required'
        ]);
        $user_id=auth()->user()->id;
        Company::where('user_id',$user_id)->update([
            'address'=>request('address'),
            'website'=>request('website'),
            'slogan'=>request('slogan'),
            'phone'=>request('phone'),
            'description'=>request('description'),
        ]);
        return redirect()->back()->with('message','Company updated successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function coverphoto(Request $request)
    {
        // $this->validate($request,[
        //     'cover_photo'=>'required|mimes:png,jpg,jpeg|max:20000'
        // ]);
        $user_id=auth()->user()->id;
        if($request->hasfile('cover_photo'))
        {
            $file=$request->file('cover_photo');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('companycoverphoto',$filename);
            Company::where('user_id',$user_id)->update([
                'cover_photo'=>$filename
            ]);
            return redirect()->back()->with('message','Coverphoto updated successfully!');
        }
    }

    public function logo(Request $request)
    {
        // $this->validate($request,[
        //     'cover_photo'=>'required|mimes:png,jpg,jpeg|max:20000'
        // ]);
        $user_id=auth()->user()->id;
        if($request->hasfile('logo'))
        {
            $file=$request->file('logo');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('companylogo',$filename);
            Company::where('user_id',$user_id)->update([
                'logo'=>$filename
            ]);
            return redirect()->back()->with('message','Companylogo updated successfully!');
        }
    }

    public function company(){
        $companies = Company::latest()->paginate(10);
        return view('company.company',compact('companies'));
      }
      
}
