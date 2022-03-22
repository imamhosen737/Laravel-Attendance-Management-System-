@extends('layouts.master')
@section('content')

<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Edit shift</h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                            <form action="{{ route('shift.update',$data->id) }}" method="post">
                                @csrf
								@method('PUT')
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="title">Shift Title</label>
                                        <input type="text" class="form-control" name="title" value="@if (old($data->title)) {{ $data->title }} @else {{ $data->title }} @endif">
                                        @error('title')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

								<div class="form-row">
									
                                    <div class="col">
                                        <label for="in_time">In Time</label>
                                        <input type="text" class="form-control" name="in_time" value="@if (old($data->in_time)) {{ old($data->in_time) }} @else {{ $data->in_time }} @endif">
                                        @error('in_time')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

									<div class="col">
										<label for="out_time">Out Time</label>
										<input type="text" class="form-control" name="out_time" value="@if (old($data->out_time)) {{ $data->out_time }}	@else {{ $data->out_time }} @endif">
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