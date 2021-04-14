<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\Entities;
use App\Models\Employees;
use App\Models\Working_Hours;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SchedulesController extends Controller
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
        $employees = Employees::all();
        return view('admin.schedule.index', compact('entity_id','employees'));
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
        return view('admin.schedule.create',compact(['departments','entity_id']));
    }
    public function getEmployees(Request $request){
        $employees = Employees::where('department_id',$request->department_id)->get();
        return response()->json([
            'employees' => $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $entity_id)
    {
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        if($request->has('employee_id') <= 0){
            return redirect()->back();
        }
        $request->merge(['entity_id' => $entity_id]);
        $request->merge(['employee_id' => json_encode($request->employee_id)]);
        foreach ($request->day as $index => $oneDay){
            $working_hour = new Working_Hours();
            $working_hour->entity_id = $request->entity_id;
            $working_hour->department_id = $request->department_id;
            $working_hour->employees_id = $request->employee_id;
            if($request->has('day_off')){
                if(in_array($oneDay, $request->day_off)){
                    $working_hour->day_off = 1;
                }
            }
            $working_hour->day = date('Y/m/d',strtotime($oneDay));
            $working_hour->from = date("H:i", strtotime($request->from[$index]));
            $working_hour->to = date("H:i", strtotime($request->to[$index]));
            $working_hour->save();
        }
        return redirect()->route('admin.schedule.index',$entity_id);
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
        $employee = Employees::findOrFail($employee_id);
        $schedules = Working_Hours::select('day', 'day_off', 'from', 'to', 'employees_id')->get();
        $array_schedules = [];
        foreach ($schedules as $index => $schedule){
            $emps = (array)json_decode($schedule->employees_id);
            if(in_array($employee->id,$emps)){
                $schedule['dayname'] = date('l', strtotime($schedule->day));
                $schedule['from'] = Carbon::parse($schedule->from)->format('h:i a');
                $schedule['to'] = Carbon::parse($schedule->to)->format('h:i a');
                $array_schedules[] = $schedule;
            }
        }
        return view('admin.schedule.show',compact(['employee','entity_id','array_schedules']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($entity_id, $employee_id)
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
    public function update(Request $request , $entity_id, $employee_id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($entity_id, $employee_id)
    {
        //
    }
}
