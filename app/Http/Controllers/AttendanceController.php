<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Leave;
use App\Models\Holiday;
use App\Models\Employee;
use App\Models\Shift_assign;
use App\Models\log;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class AttendanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function report()
    {
        session(['menu'=>'report']);
        $all_employee = Employee::get();
        $sh_d = date("Y-m").'-01';
        // $sh_d = date("Y-m-d", strtotime("first day of previous month"));
        $dateTime = new DateTime($sh_d);
        $t_day = $dateTime->format('t');
        $month = $dateTime->format('m');
        $year = $dateTime->format('Y');
        $shift_date = $year . '-' . $month;
        $emp = [];
        $employees = [];
        foreach ($all_employee as $em) {
            $shift_assign = Shift_assign::where('employee_id', $em->id)->where('month', $shift_date)->first();
            if(empty($shift_assign)){
                $shift_assign = Shift_assign::where('employee_id', $em->id)->orderBy('id', 'desc')->first();
            }
            $emp_log = [];
            $present = 0;
            $absent = 0;
            $late = 0;
            $casual=0;
            $sick=0;
            $total_day=0;
            $holidays=0;
            $weekends=0;
            for ($i = 1; $i <= $t_day; ++$i) {
                $total_day+=1;
                $gen_date = strtotime($year . '-' . $month . '-' . $i);
                $gen_date_inc = date('Y-m-d', $gen_date);
                $pun_start_time = log::where('employee_id', $em->id)->where('punch_time', 'like', "$gen_date_inc%")->first();
                $pun_end_time = log::where('employee_id', $em->id)->where('punch_time', 'like', "$gen_date_inc%")->latest('punch_time')->first();
                
                if (is_null($pun_start_time) || is_null($pun_end_time)) {
                    $holiday = Holiday::where('date', $gen_date_inc)->first();
                    $leave = Leave::where('employee_id', $em->id)->where('date', $gen_date_inc)->where('status', 'accepted')->first();
                    if(date('D', $gen_date)==$shift_assign->weekend){
                        $em_log[$i] = 'W';
                        $weekends+=1;
                    }else{
                        if (is_null($holiday)) {
                            if (is_null($leave)) {
                                $em_log[$i] = 'A';
                                $absent+=1;
                            } else {
                                $em_log[$i] = 'LV';
                                if($leave->category_id==1){
                                    $casual+=1;
                                }else{
                                    $sick+=1;
                                }
                            }
                        } else {
                            $em_log[$i] = 'H';
                            $holidays+=1;
                        }
                    }
                } else {

                    if (is_null($shift_assign)) {
                        $em_log[$i] = 'Assign Shift';
                    } else {
                        $p_s = explode(" ", $pun_start_time->punch_time);
                        $p_e = explode(" ", $pun_end_time->punch_time);
                        $pu_st = strtotime($p_s[1]);
                        $pu_en = strtotime($p_e[1]);
                        $sh_st = strtotime($shift_assign->shift->in_time);
                        $sh_en = strtotime($shift_assign->shift->out_time);
                        $lt_st = strtotime('+15 minutes', $sh_st);
                        $ab_st = strtotime('+30 minutes', $sh_st);
                        
                        if ($pu_en < $sh_en || $pu_st > $ab_st) {
                            $em_log[$i] = 'A';
                            $absent+=1;
                            
                        } elseif ($pu_st < $lt_st && $pu_en > $sh_en) {
                            $em_log[$i] = 'P';
                            $present+=1;
                        } elseif (($pu_st > $lt_st && $pu_st < $ab_st) && $pu_en > $sh_en) {
                            $em_log[$i] = 'L';
                            $late+=1;
                        }
                    }
                }
                
                array_push($emp_log, $em_log[$i]);
                if(strtotime(date('Y-m-d'))==$gen_date){
                    break;
                }
            }
            $emp['shift']=$shift_assign->shift->title;
            $emp['att']=$emp_log;
            $emp['present']=$present;
            $emp['absent']=$absent;
            $emp['late']=$late;
            $emp['casual']=$casual;
            $emp['sick']=$sick;
            $emp['wday']=$total_day-$holidays-$weekends;

            array_push($employees, $emp);
        }

        // dd($employees);
        $employee= Employee::get();
        $years=[];
        for ($i=date('Y'); $i >2000 ; $i--) { 
            array_push($years,$i);
        }
        
        return view('attendance/attendance', compact('employee','employees','t_day','month','year','years'));
    }
    public function custom(Request $request)
    {
        $dates= $request->all();
        $all_employee = Employee::get();
         $sh_d = $dates['year'].'-'.$dates['month'].'-01';
        // $sh_d = date("Y-m-d", strtotime("first day of previous month"));
        $dateTime = new DateTime($sh_d);
        $t_day = $dateTime->format('t');
        $month = $dateTime->format('m');
        $year = $dateTime->format('Y');
        $shift_date = $year . '-' . $month;
        $emp = [];
        $employees = [];
        foreach ($all_employee as $em) {
            $shift_assign = Shift_assign::where('employee_id', $em->id)->where('month', $shift_date)->first();
            if(empty($shift_assign)){
                $shift_assign = Shift_assign::where('employee_id', $em->id)->orderBy('id', 'desc')->first();
            }
            $emp_log = [];
            $present = 0;
            $absent = 0;
            $late = 0;
            $casual=0;
            $sick=0;
            $total_day=0;
            $holidays=0;
            $weekends=0;
            for ($i = 1; $i <= $t_day; ++$i) {
                $total_day+=1;
                $gen_date = strtotime($year . '-' . $month . '-' . $i);
                $gen_date_inc = date('Y-m-d', $gen_date);
                $pun_start_time = log::where('employee_id', $em->id)->where('punch_time', 'like', "$gen_date_inc%")->first();
                $pun_end_time = log::where('employee_id', $em->id)->where('punch_time', 'like', "$gen_date_inc%")->latest('punch_time')->first();
                
                if (is_null($pun_start_time) || is_null($pun_end_time)) {
                    $holiday = Holiday::where('date', $gen_date_inc)->first();
                    $leave = Leave::where('employee_id', $em->id)->where('date', $gen_date_inc)->where('status', 'accepted')->first();
                    if(date('D', $gen_date)==$shift_assign->weekend){
                        $em_log[$i] = 'W';
                        $weekends+=1;
                    }else{
                        if (is_null($holiday)) {
                            if (is_null($leave)) {
                                $em_log[$i] = 'A';
                                $absent+=1;
                            } else {
                                $em_log[$i] = 'LV';
                                if($leave->category_id==1){
                                    $casual+=1;
                                }else{
                                    $sick+=1;
                                }
                            }
                        } else {
                            $em_log[$i] = 'H';
                            $holidays+=1;
                        }
                    }
                } else {

                    if (is_null($shift_assign)) {
                        $em_log[$i] = 'Assign Shift';
                    } else {
                        $p_s = explode(" ", $pun_start_time->punch_time);
                        $p_e = explode(" ", $pun_end_time->punch_time);
                        $pu_st = strtotime($p_s[1]);
                        $pu_en = strtotime($p_e[1]);
                        $sh_st = strtotime($shift_assign->shift->in_time);
                        $sh_en = strtotime($shift_assign->shift->out_time);
                        $lt_st = strtotime('+15 minutes', $sh_st);
                        $ab_st = strtotime('+30 minutes', $sh_st);
                        
                        if ($pu_en < $sh_en || $pu_st > $ab_st) {
                            $em_log[$i] = 'A';
                            $absent+=1;
                            
                        } elseif ($pu_st < $lt_st && $pu_en > $sh_en) {
                            $em_log[$i] = 'P';
                            $present+=1;
                        } elseif (($pu_st > $lt_st && $pu_st < $ab_st) && $pu_en > $sh_en) {
                            $em_log[$i] = 'L';
                            $late+=1;
                        }
                    }
                }
                
                array_push($emp_log, $em_log[$i]);
                if(strtotime(date('Y-m-d'))==$gen_date){
                    break;
                }
            }
            $emp['shift']=$shift_assign->shift->title;
            $emp['att']=$emp_log;
            $emp['present']=$present;
            $emp['absent']=$absent;
            $emp['late']=$late;
            $emp['casual']=$casual;
            $emp['sick']=$sick;
            $emp['wday']=$total_day-$holidays-$weekends;

            array_push($employees, $emp);
        }

        // dd($employees);
        $employee= Employee::get();
        $years=[];
        for ($i=date('Y'); $i >2000 ; $i--) { 
            array_push($years,$i);
        }
        
        return view('attendance/attendance', compact('employee','employees','t_day','month','year','years'));
    }
}
