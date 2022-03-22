@extends('layouts.master')
@section('content')

<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Add new employee</h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                            <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                                        @error('name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="emp_id">Employee ID</label>
                                        <input type="text" class="form-control" name="emp_id" value="{{ old('emp_id') }}" placeholder="Employee ID">
                                        @error('emp_id')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Phone Number">
                                        @error('phone')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="email@gmail.com">
                                        @error('email')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="designation">Designation</label>
                                        <input type="text" class="form-control" name="designation" value="{{ old('designation') }}" placeholder="Designation">
                                        @error('designation')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="department">Department</label>
                                        <input type="text" class="form-control" name="department" value="{{ old('department') }}" placeholder="Department">
                                        @error('department')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="shift_id">Shift</label>
                                        <select name="shift_id" class="form-control">
                                            @foreach ($shift as $s)
                                                <option value="{{$s->id}}">{{$s->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('shift_id')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="weekend">Shift</label>
                                        {!! Form::select('weekend', ['Fri'=>'Friday','Sat'=>'Saturday','Sun'=>'Sunday','Mon'=>'Monday','Tue'=>'Tuesday','Wed'=>'Wednesday','Thu'=>'Thursday'], '', ['class'=>'form-control']) !!}
                                        @error('weekend')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address" rows="2" cols="5" placeholder="Address">{{ old('address') }}</textarea>
                                        @error('address')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="photo">Photo</label>
                                        <input type="file" class="form-control" name="photo" value="{{ old('photo') }}" placeholder="Photo">
                                        @error('photo')
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