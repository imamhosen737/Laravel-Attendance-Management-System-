@extends('layouts.master')
@section('content')

<div class="row">
     <div class="col-lg-12">
          <div class="ibox">
               <div class="ibox-title">
                    <h5>Attendance Report</h5>
                    <div class="ibox-tools">
                         <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                         </a>
                    </div>
               </div>
               <div class="ibox-content">
                    <div class="row">
                         <div class="col-md-12">
                            <div class="col-md-5 my-5">
                                <form action="{{route('att_custom')}}" method="post">
                                    @csrf
                                    <table class="table table-bordered">
                                         <tr>
                                              <td>
                                                   <select name="year" id="" class="form-control">
                                                        @foreach ($years as $i)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endforeach
                                                   </select>
                                              </td>
                                              <td>
                                                  <select name="month" id="" class="form-control">
                                                       <option value="01">January</option>
                                                       <option value="02">February</option>
                                                       <option value="03">March</option>
                                                       <option value="04">April</option>
                                                       <option value="05">May</option>
                                                       <option value="06">June</option>
                                                       <option value="07">July</option>
                                                       <option value="08">August</option>
                                                       <option value="09">September</option>
                                                       <option value="10">October</option>
                                                       <option value="11">November</option>
                                                       <option value="12">December</option>
                                                  </select>
                                              </td>
                                              <td>
                                                   <input type="submit" class="btn-sm btn-block btn-primary" value="Search">
                                              </td>
                                         </tr>
                                    </table>
                    
                                </form>
                            </div>
                    
                    
                            @php
                         //    $sh_d = date("Y-m-d", strtotime("first day of previous month"));
                         //      $dateTime = new DateTime($sh_d);
                         //      $t_day = $dateTime->format('t');    
                         //      $month = $dateTime->format('m');
                         //      $year = $dateTime->format('Y');
                            @endphp
                            <div class="row table-responsive">
                              <caption>{{$year.'-'.$month}}</caption>
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                 
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Employee Name</th>
                                        <th>Shift</th>
                                        @for ($i = 1; $i <= $t_day; $i++) <th>
                                            @php
                                            $gen_date = strtotime($year.'-'.$month.'-'.$i);
                                            echo date('d', $gen_date);
                                            echo '<br>';
                                            echo date('D', $gen_date);

                                            @endphp
                                            </th>
                                            @php
                                                  if(strtotime(date('Y-m-d'))==$gen_date){
                                                       break;
                                                  }
                                            @endphp
                                            @endfor
                                             <th>Working Day</th>
                                             <th>Present</th>
                                             <th>Absent</th>
                                             <th>Late</th>
                                             <th>Casual Leave</th>
                                             <th>Sick Leave</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employee as $k=>$em)
                                    <tr>
                                        <th>{{++$k}}</th>
                                        <td>{{$em->name}}</td>
                                        <td>{{$employees[$k-1]['shift']}}</td>
                                        @foreach ($employees[$k-1]['att'] as $lg)
                                        {{-- {{dd($lg)}} --}}
                                        <td>{{$lg}}</td>
                                        @endforeach
                                        <th>{{$employees[$k-1]['wday']}}</th>
                                        <th>{{$employees[$k-1]['present']}}</th>
                                        <th>{{$employees[$k-1]['absent']}}</th>
                                        <th>{{$employees[$k-1]['late']}}</th>
                                        <th>{{$employees[$k-1]['casual']}}</th>
                                        <th>{{$employees[$k-1]['sick']}}</th>
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
</div>


@endsection