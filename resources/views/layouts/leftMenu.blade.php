<nav class="navbar-default navbar-static-side" role="navigation">
     <div class="sidebar-collapse">
          <ul class="nav metismenu" id="side-menu">
               <li class="nav-header" style="height: 60px; margin-top: -6px;">
                    <div class="dropdown profile-element">
                         <p style="color: #1ab394;font-size: 20px;margin-top: -10px;">
                              <strong>ERP</strong>
                         </p>
                    </div>
                    <div class="logo-element">
                         APP
                    </div>
               </li>
               <li @if(session('menu')=='dashboard' ) class="active" @endif>
                    <a href="">
                         <i class="fa fa-th-large"></i>
                         <span class="nav-label">Dashboard</span>
                    </a>
               </li>
               <li @if(session('menu')=='report' ) class="active" @endif>
                    <a href="{{route('att')}}">
                         <i class="fa fa-product-hunt"></i>
                         <span class="nav-label">Report</span>
                    </a>
               </li>

               <li @if(session('menu')=='employee' ) class="active" @endif>
                    <a>
                         <i class="fa fa-product-hunt"></i>
                         <span class="nav-label">Employee Management</span>
                         <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                         <li><a href="{{route('employee.index')}}"><i class="fa fa-arrow-circle-o-right"></i>List</a></li>
                         <li><a href="{{route('employee.create')}}"><i class="fa fa-arrow-circle-o-right"></i>Add new</a></li>
                    </ul>
               </li>

               <li @if(session('menu')=='holiday' ) class="active" @endif>
                    <a>
                         <i class="fa fa-product-hunt"></i>
                         <span class="nav-label">Holiday</span>
                         <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                         <li><a href="{{route('holiday.index')}}"><i class="fa fa-arrow-circle-o-right"></i>List</a></li>
                         <li><a href="{{route('holiday.create')}}"><i class="fa fa-arrow-circle-o-right"></i>Add new</a></li>
                    </ul>
               </li>
               <li @if(session('menu')=='shift' ) class="active" @endif>
                    <a>
                         <i class="fa fa-product-hunt"></i>
                         <span class="nav-label">Shift Management</span>
                         <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                         <li><a href="{{route('shift.index')}}"><i class="fa fa-arrow-circle-o-right"></i>List</a></li>
                         <li><a href="{{route('shift.create')}}"><i class="fa fa-arrow-circle-o-right"></i>Add new</a></li>
                         <li><a href="{{route('shift_assign.index')}}"><i class="fa fa-arrow-circle-o-right"></i>Shift Assign</a></li>
                    </ul>
               </li>
          </ul>
     </div>
</nav>