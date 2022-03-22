@extends('layouts.master')
@section('content')

<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Add new holiday</h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                            <form action="{{ route('holiday.store') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="name">Holiday Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Holiday Title">
                                        @error('title')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="emp_id">Date</label>
                                        <input type="date" class="form-control" name="date" value="{{ old('date') }}" placeholder="Employee ID">
                                        @error('date')
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