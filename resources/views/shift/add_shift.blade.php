@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Add new shift</h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                            <form action="{{ route('shift.store') }}" method="post">
                                @csrf
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="title">Shift Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Shift Title">
                                        @error('title')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

								<div class="form-row">
									
                                    <div class="col">
                                        <label for="in_time">In Time</label>
                                        <input type="time" class="form-control" name="in_time" value="{{ old('in_time') }}" placeholder="In Time">
                                        @error('in_time')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

									<div class="col">
										<label for="out_time">Out Time</label>
										<input type="time" class="form-control" name="out_time" value="{{ old('out_time') }}" placeholder="Out Time">
										@error('out_time')
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