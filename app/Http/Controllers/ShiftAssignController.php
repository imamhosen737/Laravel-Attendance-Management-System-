<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Shift;
use App\Models\Employee;
use App\Models\Shift_assign;
use Illuminate\Http\Request;

class ShiftAssignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['menu' => 'shift']);
        // $monthNum  = [
        //     "01"=>"January",
        //     "02"=>"February",
        //     "03"=>"March",
        //     "04"=>"April",
        //     "05"=>"May",
        //     "06"=>"June",
        //     "07"=>"July",
        //     "08"=>"August",
        //     "09"=>"September",
        //     "10"=>"October",
        //     "11"=>"November",
        //     "12"=>"December",
        // ];
        // $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        // $monthName = $dateObj->format('F');
        $shift_assign_data = Shift_assign::get();
        return view('shift.assign_list', compact('shift_assign_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp = Employee::get();
        $shift = Shift::get();
        return view('shift.assign', compact('emp', 'shift'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'shift_id' => 'required',
            'month' => 'required',
            'weekend' => 'required'
        ]);
        Shift_assign::create($request->all());
        return redirect()->route('shift_assign.index');
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
        $data = Shift_assign::find($id);
        $emp = Employee::get();
        $shift = Shift::get();

        return view('shift.edit_assign', compact('data', 'emp', 'shift'));
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
        $request->validate([
            'employee_id' => 'required',
            'shift_id' => 'required',
            'month' => 'required',
            'weekend' => 'required'
        ]);
        Shift_assign::find($id)->update($request->all());
        return redirect()->route('shift_assign.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Shift_assign::find($id);
        $data->delete();
        return redirect()->route('shift_assign.index');
    }
}
