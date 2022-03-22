@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>New Shift Assign</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('shift_assign.store') }}" method="post">
                                @csrf
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="employee_id">Select Employee</label>
                                        <select name="employee_id" id="employee_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($emp as $emp_data)
                                                @if (old('employee_id') == $emp_data->id)
                                                    <option value="{{ $emp_data->id }}" {{ 'selected' }}>
                                                        {{ $emp_data->name }}</option>
                                                @else
                                                    <option value="{{ $emp_data->id }}">{{ $emp_data->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('employee_id')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="shift_id ">Select Shift</label>
                                        <select name="shift_id" id="shift_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($shift as $shift_data)
                                                @if (old('shift_id') == $shift_data->id)
                                                    <option value="{{ $shift_data->id }}" {{ 'selected' }}>
                                                        {{ $shift_data->title }}</option>
                                                @else
                                                    <option value="{{ $shift_data->id }}">{{ $shift_data->title }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('shift_id ')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="month">Month</label>
                                        {{-- <input type="text" class="form-control" name="month" value="{{ old('month') }}"
                                            placeholder="Month"> --}}
                                            <select name="month" id="" class="form-control">
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                           </select>
                                        @error('month')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="weekend">Weekend</label>
                                        {{-- <input type="text" class="form-control" name="weekend"
                                            value="{{ old('weekend') }}" placeholder="Weekend"> --}}
                                            
                                            {!! Form::select('weekend', ['Fri'=>'Friday','Sat'=>'Saturday','Sun'=>'Sunday','Mon'=>'Monday','Tue'=>'Tuesday','Wed'=>'Wednesday','Thu'=>'Thursday'], '', ['class'=>'form-control']) !!}
                                        @error('weekend')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="">&nbsp;</label>
                                    <input type="submit" class="btn btn-block btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
