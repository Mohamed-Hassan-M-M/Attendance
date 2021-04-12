<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\CreateRequest;
use App\Http\Requests\Department\UpdateRequest;
use App\Models\Departments;
use App\Models\Entities;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
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
        $departments = Departments::where('entity_id',$entity_id)->get();

        return view('admin.department.index', compact('departments','entity_id'));
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
        return view('admin.department.create',compact(['entity_id']));
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

        Departments::create($request->all());

        return redirect()->route('admin.department.index',$entity_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($entity_id, $department_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $department = Departments::findOrFail($department_id);
        return view('admin.department.show',compact(['entity_id','department']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($entity_id, $department_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $department = Departments::findOrFail($department_id);

        return view('admin.department.edit', compact('department','entity_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request , $entity_id, $department_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $department = Departments::findOrFail($department_id);

        $department->update($request->all());

        return redirect()->route('admin.department.index',$entity_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($entity_id, $department_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $department = Departments::findOrFail($department_id);
        $department->delete();
        return redirect()->route('admin.department.index',$entity_id);
    }
}
