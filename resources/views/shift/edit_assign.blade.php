@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Edit Shift Assign</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('shift_assign.update', $data->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="employee_id">Select Employee</label>
                                        <select name="employee_id" id="employee_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($emp as $emp_data)
                                                @if (old('employee_id') == $emp_data->id)
                                                    <option value="{{ $emp_data->id }}"
                                                        @if ($data->employee->name == $emp_data->name) {{ 'selected' }} @endif>
                                                        {{ $emp_data->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $emp_data->id }}"
                                                        @if ($data->employee->name == $emp_data->name) {{ 'selected' }} @endif>
                                                        {{ $emp_data->name }}
                                                    </option>
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
                                                    <option value="{{ $shift_data->id }}"
                                                        @if ($data->shift->title == $shift_data->title) {{ 'selected' }} @endif>
                                                        {{ $shift_data->title }}</option>
                                                @else
                                                    <option value="{{ $shift_data->id }}"
                                                        @if ($data->shift->title == $shift_data->title) {{ 'selected' }} @endif>
                                                        {{ $shift_data->title }}</option>
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
                                        <input type="text" class="form-control" name="month"
                                            value="@if (old($data->month)) {{ old($data->month) }} @else{{ $data->month }} @endif">
                                        @error('month')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="weekend">Weekend</label>
                                        {{-- <input type="text" class="form-control" name="weekend"
                                            value="@if (old($data->weekend)) {{ old($data->weekend) }}@else {{ $data->weekend }}@endif"> --}}
                                            
                                        {!! Form::select('weekend', ['Fri' => 'Friday', 'Sat' => 'Saturday', 'Sun' => 'Sunday', 'Mon' => 'Monday', 'Tue' => 'Tuesday', 'Wed' => 'Wednesday', 'Thu' => 'Thursday'], $data->weekend, ['class' => 'form-control']) !!}
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
