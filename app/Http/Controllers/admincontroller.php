<?php

namespace App\Http\Controllers;
use App\Models\company;

use Illuminate\Http\Request;
use App\Http\Requests\validationRequest;

class admincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = company::paginate(5);
      return view('companies')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(validationRequest $request)
{    
 
    $company = new company();
    $company->name = $request->input('name');
    $company->email = $request->input('email');
    
    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();
    $storeimage=$image->storeAs('logos', $imageName ,'public');
    $company->logo = $imageName;
    $company->save();
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = company::find($id);
        return $record; 

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id=$request->input('companyid');  
        $company = company::find($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->save();
        return redirect()->route('companies');
       
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = company::find($id);
        $record->delete();
        return redirect()->route('companies');
    }
}
