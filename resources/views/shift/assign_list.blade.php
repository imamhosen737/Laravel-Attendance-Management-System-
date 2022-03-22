@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Shift Assign List</h5>
                    <div class="ibox-tools">              
                    <a href="{{ route('shift_assign.create') }}" class="btn btn-xs btn-primary mb-2">Assign New </a>
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
                                        <th>Employee</th>
								<th>Shift</th>
                                        <th>Month</th>
                                        <th>Weekend</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shift_assign_data as $i => $data)
                                   <tr>
								<td>{{ ++$i }}</td>
								<td>{{ $data->employee->name  }}</td>
								<td>{{ $data->shift->title  }}</td>
								<td>{{ $data->month  }}</td>
								<td>{{ $data->weekend  }}</td>
								<td>
								     <form action="{{ route('shift_assign.destroy', $data->id) }}" method="post"
                                                  id="delete{{ $data->id }}">
                                                  @csrf
                                                  @method('delete')
                                                  <a href="{{ route('shift_assign.edit', $data->id) }}" class=" btn-xs btn-success">Edit</a>
                                                  <a title="delete" onclick="document.getElementById('delete{{ $data->id }}').submit()"
                                                        class="btn-xs btn-danger">Delete</a>
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