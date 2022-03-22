@extends('layouts.master')
@section('content')

<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Edit Employee</h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                            <form action="{{ route('employee.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $data->name }}" placeholder="Name">
                                        @error('name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="emp_id">Employee ID</label>
                                        <input type="text" class="form-control" name="emp_id" value="{{ $data->emp_id }}"placeholder="Employee ID">
                                        @error('emp_id')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $data->phone }}"
                                            placeholder="Phone Number">
                                        @error('phone')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                    
                                    <div class="col">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" value="{{ $data->email }}"
                                            placeholder="email@gmail.com">
                                        @error('email')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="designation">Designation</label>
                                        <input type="text" class="form-control" name="designation" value="{{ $data->designation }}"
                                            placeholder="Designation">
                                        @error('designation')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="department">Department</label>
                                        <input type="text" class="form-control" name="department" value="{{ $data->department }}"
                                            placeholder="Department">
                                        @error('department')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address" rows="2" cols="5"
                                            placeholder="Address">{{ $data->address }}</textarea>
                                        @error('address')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="photo">Photo</label>
                                        <input type="file" class="form-control" name="photo" value="{{ $data->photo }}"
                                            placeholder="Photo">
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