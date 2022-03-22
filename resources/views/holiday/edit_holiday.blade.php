@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Edit holiday</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('holiday.update',$data->id) }}" method="post">
								@method('PUT')
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="name">Holiday Title</label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            value="@if (old($data->title)) {{ old($data->title) }}@else{{ $data->title }} @endif"
                                            placeholder="Holiday Title">
											@error('title')
												<span style="color: red">{{ $message }}</span>
											@enderror
                                    </div>

                                    <div class="col">
                                        <label for="date">Date</label>
                                        <input type="text" class="form-control" name="date"
                                            value="@if (old($data->date)) {{ old($data->date) }}@else{{ $data->date }} @endif">
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
