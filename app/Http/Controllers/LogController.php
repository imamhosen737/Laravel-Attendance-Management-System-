<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\log;
use App\Models\User;
use App\Models\Leave;
use App\Models\Holiday;
use App\Models\Employee;
use App\Models\Shift_assign;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function show()
    {
        $log = log::get();
        return response(
            [
                'status' => true,
                'massage' => 'time log fetched successfully',
                'data' => $log
            ],
            200

        );
    }
    public function create(Request $data)
    {

        $time_log = log::where('employee_id', $data->employee_id)->where('punch_time', $data->punch_time)->get();
        $a = count($time_log);
        if ($a > 0) {
            return response(
                [
                    'status' => false,
                    'massage' => 'Punch another time!',
                ]
            );
        }
        $dd = $data->all();
        // dd($data);
        $em = Employee::where('emp_id', $data->employee_id)->first();
        $dd['employee_id'] = $em->id;
        $log = log::create($dd);
        return response(
            [
                'status' => true,
                'massage' => 'time log saved successfully',
                'data' => $log
            ],
            201
        );
    }
    public function user(Request $data)
    {
        $r = $data->only('email', 'password');
        if (!auth()->attempt($r)) {
            return response(
                [
                    'status' => true,
                    'massage' => 'Log in faild',
                ],
                201
            );
        }
        $u = auth()->user();

        return response(
            [
                'status' => true,
                'massage' => 'Log in successful!',
                'data' => $u
            ],
            201
        );
    }
    public function attandance_report()
    {
        $all_employee = Employee::get();
        // $sh_d = date("Y-m-d");
        $sh_d = date("Y-m-d", strtotime("first day of previous month"));
        $dateTime = new DateTime($sh_d);
        $t_day = $dateTime->format('t');
        $month = $dateTime->format('m');
        $year = $dateTime->format('Y');
        $shift_date = $year . '-' . $month;

        // $pun_time['start_time']=log::where('employee_id', '1')->where('punch_time', 'like', "2022-01-12%")->first();
        // dd($pun_time['start_time']);
        $emp = [];
        $employee = [];
        foreach ($all_employee as $em) {
            $shift_assign = Shift_assign::where('employee_id', $em->id)->where('month', $shift_date)->first();
            // dd($shift_assign);
            // dd($t_day);
            $emp_log = [];
            $present = 0;
            $absent = 0;
            $late = 0;
            for ($i = 1; $i <= $t_day; ++$i) {
                // echo $i.'<br>';
                $gen_date = strtotime($year . '-' . $month . '-' . $i);
                $gen_date_inc = date('Y-m-d', $gen_date);
                $pun_start_time = log::where('employee_id', $em->id)->where('punch_time', 'like', "$gen_date_inc%")->first();
                $pun_end_time = log::where('employee_id', $em->id)->where('punch_time', 'like', "$gen_date_inc%")->latest('punch_time')->first();
                // dd($pun_start_time);
                if (is_null($pun_start_time) || is_null($pun_end_time)) {
                    $holiday = Holiday::where('date', $gen_date_inc)->first();
                    $leave = Leave::where('employee_id', $em->id)->where('date', $gen_date_inc)->where('status', 'accepted')->first();
                    if (is_null($holiday)) {
                        if (is_null($leave)) {
                            $em_log[$i] = 'A';
                            $absent+=1;
                        } else {
                            $em_log[$i] = 'LV';
                        }
                    } else {
                        $em_log[$i] = 'H';
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
                        // var_dump($sh_en);
                        // dd(date('H:i:s', $ab_st));
                        if ($pu_en < $sh_en || $pu_st > $ab_st) {
                            $em_log[$i] = 'A';
                            $absent+=1;
                            // dd($pun_start_time);
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
                
            }
            $emp['att']=$emp_log;
            $emp['present']=$present;
            $emp['absent']=$absent;
            $emp['late']=$late;
            array_push($employee, $emp);
        }
        return response(
            [
                'status' => true,
                'massage' => 'Attandance data fetched successfully',
                'employee' => $employee
            ],
            200

        );
    }
}
