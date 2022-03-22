@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Shift List</h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead >
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
										<th>In Time</th>
										<th>Out Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shift_data as $i => $data)
                                        <tr>
											<td>{{ ++$i }}</td>
											<td>{{ $data->title }}</td>
											<td>{{ $data->in_time }}</td>
											<td>{{ $data->out_time }}</td>
											<td>
												<form action="{{ route('shift.destroy',$data->id) }}" method="post" id="delete{{ $data->id }}">
													@csrf
													@method('DELETE')
													<a href="{{ route('shift.edit',$data->id) }}" class="btn btn-xs btn-success">Edit</a>
													<a title="delete" onclick="document.getElementById('delete{{ $data->id }}').submit()" class="btn btn-xs btn-danger">Delete</a>
												</form>
											</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>


@endsection