<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\Departments;
use App\Models\Entities;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $entity_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $employees = Employees::where('entity_id',$entity_id)->get();

        return view('admin.employee.index', compact('employees','entity_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($entity_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $departments = Departments::where('entity_id',$entity_id)->get();
        return view('admin.employee.create',compact(['departments','entity_id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request, $entity_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $request->merge(['entity_id' => $entity_id]);

        Employees::create($request->all());

        return redirect()->route('admin.employee.index',$entity_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($entity_id,$employee_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $employee = Employees::find($employee_id);
        return view('admin.employee.show',compact(['entity_id','employee']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($entity_id, $employee_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $departments = Departments::where('entity_id',$entity_id)->get();
        $employee = Employees::find($employee_id);
        return view('admin.employee.edit', compact('departments','employee','entity_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request , $entity_id, $employee_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $request->merge(['entity_id' => $entity_id]);

        $employee = Employees::findOrFail($employee_id);

        $employee->update($request->all());

        return redirect()->route('admin.employee.index',$entity_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($entity_id, $employee_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $employee = Employees::findOrFail($employee_id);
        $employee->delete();
        return redirect()->route('admin.employee.index',$entity_id);
    }
}
