<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use App\Models\company;
class employeecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $employeedata=employee::all();
        $companydata=company::select('comp_id','name')->get();
        $companyMap = [];
        foreach ( $companydata as $company) {
            $companyMap[$company['comp_id']] = $company;
        }
        $mergedData = [];
        foreach ($employeedata as $employee) {
        
            $compId = $employee['comp_id'];
            $company = isset($companyMap[$compId]) ? $companyMap[$compId] : null;
            $mergedData[] = [
                'employee_id' => $employee['employee_id'],
                'firstname' => $employee['firstname'],
                'lastname' => $employee['lastname'],
                'comp_id' => $employee['comp_id'],
                'email' => $employee['email'],
                'phone' => $employee['phone'],
                'created_at' => $employee['created_at'],
                'updated_at' => $employee['updated_at'],
                'company_name' => $company ? $company['name'] : null, 
            ];
        }
        
        return view('employee', [
            'employeedata' => $mergedData,
            'companydata' => $companydata,
        ]);
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
    public function store(Request $request)
    {
        $employee = new employee();
        $employee->firstname = $request->input('name');
        $employee->lastname = $request->input('lastname');
        $employee->comp_id = $request->input('employeeid');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');

        $employee->save();
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
        $record = employee::find($id);
        return $record; 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       
         
        $id=$request->input('employeeid');  
        $company = employee::find($id);
        $company->firstname = $request->input('name');
        $company->lastname = $request->input('lastname');
        $company->email = $request->input('email');
        $company->phone = $request->input('phone');
        $company->save();
        return redirect()->route('employee');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = employee::where('employee_id',$id);
        $record->delete();
        return redirect()->route('employee');
    }
}
