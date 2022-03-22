@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Holiday List</h5>
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
										<th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($holiday_data as $i => $data)
                                        <tr>
											<td>{{ ++$i }}</td>
											<td>{{ $data->title }}</td>
											<td>{{ $data->date }}</td>
											<td>
												<form action="{{ route('holiday.destroy', $data->id) }}" method="post"
                                                    id="delete{{ $data->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('holiday.edit', $data->id) }}" class=" btn-xs btn-success">Edit</a>
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