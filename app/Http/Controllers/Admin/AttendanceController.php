<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attendance;
use App\Models\Deduction;
use App\Models\Employees;
use App\Models\Entities;
use App\Models\Working_Hours;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;

class AttendanceController extends Controller
{
    //for attendance
    public function index(Request $request, $entity_id){
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        return view('admin.attendance.index', compact(['entity_id']));
    }

    public function getAttendance(Request $request){
        //check if date to is greater than today make it today date
        /*$curdate=strtotime(date('Y-m-d'));
        $mydate=strtotime($request->to);
        if($mydate > $curdate)
        {
            $request->merge(['to' => date('Y-m-d')]);
        }*/

        $employee = Employees::find($request->employee_id);
        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);
        $diff =  $to->diffInDays($from);
        $from_schedule = [];
        $to_schedule = [];
        $from_actual = [];
        $to_actual = [];
        $dates = [];
        do{
            $dates[] = $from->format('Y-m-d');
            $dat = $from->format('Y-m-d');

            $schedules = Working_Hours::where('day',$from->format('Y-m-d'))->orderBy('created_at', 'DESC')->get();
            foreach ($schedules as $schedule){
                $emps = (array)json_decode($schedule->employees_id);
                if(in_array($employee->id,$emps)){
                    if($schedule->day_off == 1){
                        $from_actual[] = '---';
                        $to_actual[] = '---';
                        $from_schedule[] = 'day off';
                        $to_schedule[] = 'day off';
                        goto dayOff;
                    }
                    $from_schedule[] = Carbon::parse($schedule->from)->format('h:ia');
                    $to_schedule[] = Carbon::parse($schedule->to)->format('h:ia');
                    break;
                }
            }

            $attendance_signIn = Attendance::where('employee_id',$employee->id)
                ->where(DB::raw('DATE(`created_at`)'),$dat)
                ->whereIn('status',['late','absent'])->get();
            if($attendance_signIn->count()>0){
                if($attendance_signIn[0]->status == 'absent'){
                    $from_actual[] = 'absent';
                    $to_actual[] = 'absent';
                    goto dayOff;
                }
                else{
                    $from_actual[] = (Carbon::parse($attendance_signIn[0]->created_at))->format('h:ia');
                }
            }
            else{
                $from_actual[] = Carbon::parse($schedule->from)->format('h:ia');
            }

            $attendance_signOut = Attendance::where('employee_id',$employee->id)->where('status','signOut')
                ->where(DB::raw('DATE(`created_at`)'),$dat)->get();
            // if no sign out take last break in
            if(!$attendance_signOut){
                $attendance_signOut = Attendance::where('employee_id',$employee->id)->where('status','breakin')
                    ->where(DB::raw('DATE(`created_at`)'),$dat)->get();
            }
            $to_actual[] = (Carbon::parse($attendance_signOut[0]->created_at))->format('h:ia');

            dayOff:
            $from = $from->addDays(1);
            $diff--;
        }while($diff>=0);

        return response()->json([
            'employee'=>$employee,
            'entity'=>$employee->entity,
            'department'=>$employee->department,
            'from_schedule'=>$from_schedule,
            'from_actual'=>$from_actual,
            'to_schedule'=>$to_schedule,
            'to_actual'=>$to_actual,
            'dates'=>$dates,
        ]);
    }

    //for time sheet
    public function timeSheet(Request $request, $entity_id){
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        return view('admin.attendance.timeSheet', compact(['entity_id']));
    }

    public function getTimeSheet(Request $request){
        //check if date to is greater than today make it today date
        /*$curdate=strtotime(date('Y-m-d'));
        $mydate=strtotime($request->to);
        if($mydate > $curdate)
        {
            $request->merge(['to' => date('Y-m-d')]);
        }*/
        $employee = Employees::find($request->employee_id);
        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);
        $diff =  $to->diffInDays($from);
        $from_schedule = [];
        $to_schedule = [];
        $from_actual = [];
        $to_actual = [];
        $v_in = [];
        $v_out = [];
        $dates = [];
        do{
            $dates[] = $from->format('Y-m-d');
            $dat = $from->format('Y-m-d');

            $schedules = Working_Hours::where('day',$from->format('Y-m-d'))->orderBy('created_at', 'DESC')->get();

            foreach ($schedules as $index => $schedule){
                $emps = (array)json_decode($schedule->employees_id);
                if(in_array($employee->id,$emps)){
                    if($schedule->day_off == 1){
                        $from_actual[] = '---';
                        $to_actual[] = '---';
                        $v_in[] = '---';
                        $v_out[] = '---';
                        $from_schedule[] = 'day off';
                        $to_schedule[] = 'day off';
                        goto dayOff;
                    }
                    $from_schedule[] = Carbon::parse($schedule->from)->format('h:ia');
                    $f_schedule = Carbon::parse($schedule->from)->format('h:i:s');
                    $to_schedule[] = Carbon::parse($schedule->to)->format('h:ia');
                    $t_schedule = Carbon::parse($schedule->to)->format('h:i:s');
                    break;
                }
            }

            $attendance_signIn = Attendance::where('employee_id',$employee->id)
                ->where(DB::raw('DATE(`created_at`)'),$dat)
                ->whereIn('status',['late','absent'])->get();
            if($attendance_signIn->count()>0){
                if($attendance_signIn[0]->status == 'absent'){
                    $from_actual[] = 'absent';
                    $to_actual[] = 'absent';
                    $v_in[] = 'absent';
                    $v_out[] = 'absent';
                    goto dayOff;
                }
                else{
                    $from_actual[] = (Carbon::parse($attendance_signIn[0]->created_at))->format('h:ia');
                    $v_in[] = CarbonInterval::seconds(strtotime(Carbon::parse($attendance_signIn[0]->created_at)->format('h:i:s')) - strtotime($f_schedule))->cascade()->forHumans(null, true);
                }
            }
            else{
                $from_actual[] = Carbon::parse($schedule->from)->format('h:ia');
                $v_in[] = '00:00';
            }

            $attendance_signOut = Attendance::where('employee_id',$employee->id)->where('status','signOut')
                ->where(DB::raw('DATE(`created_at`)'),$dat)->get();
            // if no sign out take last break in
            if(!$attendance_signOut){
                $attendance_signOut = Attendance::where('employee_id',$employee->id)->where('status','breakin')
                    ->where(DB::raw('DATE(`created_at`)'),$dat)->get();
            }

            $to_actual[] = (Carbon::parse($attendance_signOut[0]->created_at))->format('h:ia');

            if(strtotime($t_schedule) - strtotime(Carbon::parse($attendance_signOut[0]->created_at)->format('h:i:s')) > 0){
                $v_out[] = '+' . CarbonInterval::seconds(strtotime($t_schedule) - strtotime(Carbon::parse($attendance_signOut[0]->created_at)->format('h:i:s')) )->cascade()->forHumans(null, true);
            }
            elseif (strtotime($t_schedule) - strtotime(Carbon::parse($attendance_signOut[0]->created_at)->format('h:i:s')) < 0){
                $v_out[] = '-' . CarbonInterval::seconds(strtotime($t_schedule) - strtotime(Carbon::parse($attendance_signOut[0]->created_at)->format('h:i:s')) )->cascade()->forHumans(null, true);
            }
            else{
                $v_out[] = '00:00';
            }


            dayOff:
            $from = $from->addDays(1);
            $diff--;
        }while($diff>=0);

        return response()->json([
            'employee'=>$employee,
            'entity'=>$employee->entity,
            'department'=>$employee->department,
            'from_schedule'=>$from_schedule,
            'from_actual'=>$from_actual,
            'to_schedule'=>$to_schedule,
            'to_actual'=>$to_actual,
            'v_in'=>$v_in,
            'v_out'=>$v_out,
            'dates'=>$dates,
        ]);
    }

    //for deduction
    public function deduction(Request $request, $entity_id){
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        return view('admin.attendance.deduction', compact(['entity_id']));
    }

    public function getDeduction(Request $request){
        //check if date to is greater than today make it today date
        /*$curdate=strtotime(date('Y-m-d'));
        $mydate=strtotime($request->to);
        if($mydate > $curdate)
        {
            $request->merge(['to' => date('Y-m-d')]);
        }*/
        $employee = Employees::find($request->employee_id);
        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);
        $diff =  $to->diffInDays($from);
        $from_schedule = [];
        $to_schedule = [];
        $from_actual = [];
        $to_actual = [];
        $v_in = [];
        $v_out = [];
        $dates = [];
        $deduction = [];
        $conformance = [];
        $conformance_time = 0;
        do{
            $dates[] = $from->format('Y-m-d');
            $dat = $from->format('Y-m-d');

            //get deduction
            $deduct = Deduction::where('employee_id',$employee->id)->where(DB::raw('DATE(`day`)'),$dat)->select('amount')->orderBy('created_at', 'DESC')->first();
            if(!$deduct){
                $deduction[] = 0;
            }
            else{
                $deduction[] = $deduct->amount;
            }

            $schedules = Working_Hours::where('day',$from->format('Y-m-d'))->orderBy('created_at', 'DESC')->get();

            foreach ($schedules as $index => $schedule){
                $emps = (array)json_decode($schedule->employees_id);
                if(in_array($employee->id,$emps)){
                    if($schedule->day_off == 1){
                        $from_actual[] = '---';
                        $to_actual[] = '---';
                        $v_in[] = '---';
                        $v_out[] = '---';
                        $from_schedule[] = 'day off';
                        $to_schedule[] = 'day off';
                        $conformance[] = '---';
                        goto dayOff;
                    }
                    $from_schedule[] = Carbon::parse($schedule->from)->format('h:ia');
                    $f_schedule = Carbon::parse($schedule->from)->format('h:i:s');
                    $to_schedule[] = Carbon::parse($schedule->to)->format('h:ia');
                    $t_schedule = Carbon::parse($schedule->to)->format('h:i:s');
                    break;
                }
            }
            // get sign in time and actual sign in time
            $attendance_signIn = Attendance::where('employee_id',$employee->id)
                ->where(DB::raw('DATE(`created_at`)'),$dat)
                ->whereIn('status',['late','absent'])->get();
            if($attendance_signIn->count()>0){
                //in case of absent
                if($attendance_signIn[0]->status == 'absent'){
                    $from_actual[] = 'absent';
                    $to_actual[] = 'absent';
                    $v_in[] = 'absent';
                    $v_out[] = 'absent';
                    $conformance[] = '00:00';
                    goto dayOff;
                }
                else{//in case of late
                    $from_actual[] = (Carbon::parse($attendance_signIn[0]->created_at))->format('h:ia');
                    $v_in[] = CarbonInterval::seconds(strtotime(Carbon::parse($attendance_signIn[0]->created_at)->format('h:i:s')) - strtotime($f_schedule))->cascade()->forHumans(null, true);
                    $conformance_time  = (Carbon::parse($attendance_signIn[0]->created_at))->format('h:ia');
                }
            }
            else{
                //in case of sign in
                $from_actual[] = Carbon::parse($schedule->from)->format('h:ia');
                $v_in[] = '00:00';
                $conformance_time = Carbon::parse($schedule->from)->format('h:ia');
            }

            // get sign out time and actual sign out time
            $attendance_signOut = Attendance::where('employee_id',$employee->id)->where('status','signOut')
                ->where(DB::raw('DATE(`created_at`)'),$dat)->get();
            // if no sign out take last break in
            if(!$attendance_signOut){
                $attendance_signOut = Attendance::where('employee_id',$employee->id)->where('status','breakin')
                    ->where(DB::raw('DATE(`created_at`)'),$dat)->get();
            }
            $to_actual[] = (Carbon::parse($attendance_signOut[0]->created_at))->format('h:ia');

            if(strtotime($t_schedule) - strtotime(Carbon::parse($attendance_signOut[0]->created_at)->format('h:i:s')) > 0){
                $v_out[] = '+' . CarbonInterval::seconds(strtotime($t_schedule) - strtotime(Carbon::parse($attendance_signOut[0]->created_at)->format('h:i:s')) )->cascade()->forHumans(null, true);
            }
            elseif (strtotime($t_schedule) - strtotime(Carbon::parse($attendance_signOut[0]->created_at)->format('h:i:s')) < 0){
                $v_out[] = '-' . CarbonInterval::seconds(strtotime($t_schedule) - strtotime(Carbon::parse($attendance_signOut[0]->created_at)->format('h:i:s')) )->cascade()->forHumans(null, true);
            }
            else{
                $v_out[] = '00:00';
            }

            //calculate conformance
            $conformance_time = strtotime((Carbon::parse($attendance_signOut[0]->created_at))->format('h:ia')) - strtotime($conformance_time);
            $attendance_breakout = Attendance::where('employee_id',$employee->id)->where('status','breakout')
                ->where(DB::raw('DATE(`created_at`)'),$dat)->orderBy('created_at','ASC')->get();
            $attendance_breakin = Attendance::where('employee_id',$employee->id)->where('status','breakin')
                ->where(DB::raw('DATE(`created_at`)'),$dat)->orderBy('created_at','ASC')->get();
            foreach ($attendance_breakin as $index => $breakin){
                $conformance_time -= (strtotime((Carbon::parse($breakin->created_at))->format('h:ia')) - strtotime((Carbon::parse($attendance_breakout[$index]->created_at))->format('h:ia')));
            }
            $conformance[] = CarbonInterval::seconds($conformance_time)->cascade()->forHumans();

            dayOff:
            $from = $from->addDays(1);
            $diff--;
        }while($diff>=0);

        return response()->json([
            'employee'=>$employee,
            'department'=>$employee->department,
            'from_schedule'=>$from_schedule,
            'from_actual'=>$from_actual,
            'to_schedule'=>$to_schedule,
            'to_actual'=>$to_actual,
            'v_in'=>$v_in,
            'v_out'=>$v_out,
            'dates'=>$dates,
            'conformance'=>$conformance,
            'deduction'=>$deduction,
        ]);
    }

    public function saveDeduction(Request $request){

        $deduction = Deduction::where('employee_id',$request->employee_id)
            ->where(DB::raw('DATE(`day`)'),$request->date)->first();
        if($deduction){
            $deduction->amount = $request->amount;
            $deduction->save();
        }
        else{
            Deduction::create([
                'employee_id'=>$request->employee_id,
                'amount'=>$request->amount,
                'day'=>$request->date
            ]);
        }
        return response()->json([
            'status'=>true
        ]);
    }


}
