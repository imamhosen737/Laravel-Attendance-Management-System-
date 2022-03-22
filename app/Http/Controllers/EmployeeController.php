<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Shift;
use App\Models\Shift_assign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['menu'=>'employee']);
        $data = Employee::get();
        return view('employees.emp_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shift=Shift::get();
        return view('employees.add_emp',compact('shift'));
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
            'name' => 'required',
            'emp_id' => 'required|unique:employees,emp_id',
            'email' => 'required|email',
            'phone' => 'required|min:11|max:14|',
            'address' => 'required|',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|',
            'designation' => 'required',
            'department' => 'required'
        ]);
        $input = $request->all();
        // dd($input);
        $shift=$input['shift_id'];
        $weekend=$input['weekend'];
        unset($input['shift_id']);
        unset($input['weekend']);
        $filename = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('/images/'), $filename);
        $input['photo'] = "$filename";
        $id=Employee::create($input)->id;
        Shift_assign::create(array('employee_id'=>$id,'shift_id'=>$shift,'weekend'=>$weekend,'month'=>date('Y-m')));
        return redirect()->route('employee.index');
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
        $data = Employee::find($id);
        $shift=Shift::get();
        return view('employees.edit_emp', compact('data','shift'));
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:11|max:14|',
            'address' => 'required|',
            'designation' => 'required',
            'department' => 'required',
        ]);

        $empData['name'] = $request->name;
        $empData['email'] = $request->email;
        $empData['phone'] = $request->phone;
        $empData['address'] = $request->address;
        $empData['designation'] = $request->designation;
        $empData['department'] = $request->department;

        if (!empty($request->photo)) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|',
            ]);
            $filename = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('/images/'), $filename);
            $empData['photo'] = $filename;
            $del = '/images/' . Employee::find($id)->photo;
            File::delete(public_path($del));
        }
        Employee::find($id)->update($empData);
        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = '/images/' . Employee::find($id)->photo;
        File::delete(public_path($del));
        Employee::find($id)->delete();
        return redirect()->route('employee.index');
    }
}
