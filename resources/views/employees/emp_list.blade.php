@extends('layouts.master')
@section('content')
<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Employee List</h5>
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
                                        <th>Photo</th>
                                        <th>Nmae</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $i => $emp)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                <img src="{{asset('/images/'.$emp->photo)}}" height="50" width="50" class="img-fluid" alt="">
                                            </td>
                                            <td>{{ $emp->name }}</td>
                                            <td>{{ $emp->email }}</td>
                                            <td>{{ $emp->phone }}</td>
                                            <td>{{ $emp->address }}</td>
                                            <td>{{ $emp->designation }}</td>
                                            <td>{{ $emp->department }}</td>
                                            <td>
                                                <form action="{{ route('employee.destroy', $emp->id) }}" method="post"
                                                    id="delete{{ $emp->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('employee.edit', $emp->id) }}" class=" btn-xs btn-success">Edit</a>
                                                    <a title="delete" onclick="document.getElementById('delete{{ $emp->id }}').submit()"
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