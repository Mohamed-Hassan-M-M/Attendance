<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="@if(auth()->check()) @if(auth()->user()->hasRole('Super Admin')) {{route('superAdmin.home')}} @else {{route('admin.home',auth()->user()->entity_id)}} @endif @endif " class="brand-link">
        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{__('messages.Attendance')}}</span>
    </a>

@auth('web')
    <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('admin.profile')}}" class="d-block">{{auth('web')->user()->name}}</a>
                </div>
            </div>
            @if(\Illuminate\Support\Str::contains(url()->current(),'admin'))
                <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
                    <div class="info">
                        <h3><a href="{{route('admin.home',url()->current()[strpos(url()->current(),'/admin')+7])}}" class="d-block">@if(auth()->user()->hasRole('Super Admin')) {{(app()->getLocale() == 'ar')? (\App\Models\Entities::find(url()->current()[strpos(url()->current(),'/admin')+7]))->name_ar : (\App\Models\Entities::find(url()->current()[strpos(url()->current(),'/admin')+7]))->name}} @else {{(app()->getLocale() == 'ar')? (\App\Models\Entities::find(auth()->user()->entity_id))->name_ar : (\App\Models\Entities::find(auth()->user()->entity_id))->name}} @endif</a></h3>
                    </div>
                </div>
            @endif

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                @if(\Illuminate\Support\Str::contains(url()->current(),'admin'))
                    <!-- Sidebar Menu for Admin -->
                        <li class="nav-item">
                            <a href="@if(auth()->user()->hasRole('Super Admin')) {{route('admin.department.index',url()->current()[strpos(url()->current(),'/admin')+7])}} @else {{route('admin.department.index',auth()->user()->entity_id)}} @endif" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    {{__('messages.Departments')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="@if(auth()->user()->hasRole('Super Admin')) {{route('admin.employee.index',url()->current()[strpos(url()->current(),'/admin')+7])}} @else {{route('admin.employee.index',auth()->user()->entity_id)}} @endif" class="nav-link">

                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    {{__('messages.Employees')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="@if(auth()->user()->hasRole('Super Admin')) {{route('admin.schedule.index',url()->current()[strpos(url()->current(),'/admin')+7])}} @else {{route('admin.schedule.index',auth()->user()->entity_id)}} @endif" class="nav-link">
                                <i class="nav-icon fas fa-pen"></i>
                                <p>
                                    {{__('messages.Schedule')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="@if(auth()->user()->hasRole('Super Admin')) {{route('admin.attendance.index',url()->current()[strpos(url()->current(),'/admin')+7])}} @else {{route('admin.attendance.index',auth()->user()->entity_id)}} @endif" class="nav-link">

                                <i class="nav-icon fas fa-pen"></i>
                                <p>
                                    {{__('messages.Attendance')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="@if(auth()->user()->hasRole('Super Admin')) {{route('admin.attendance.timeSheet',url()->current()[strpos(url()->current(),'/admin')+7])}} @else {{route('admin.attendance.timeSheet',auth()->user()->entity_id)}} @endif" class="nav-link">

                                <i class="nav-icon fas fa-pen"></i>
                                <p>
                                    {{__('messages.Time Sheet')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="@if(auth()->user()->hasRole('Super Admin')) {{route('admin.attendance.deduction',url()->current()[strpos(url()->current(),'/admin')+7])}} @else {{route('admin.attendance.deduction',auth()->user()->entity_id)}} @endif" class="nav-link">

                                <i class="nav-icon fas fa-pen"></i>
                                <p>
                                    {{__('messages.Attendance Deduction')}}
                                </p>
                            </a>
                        </li>
                        <!-- /.sidebar-menu -->
                @endif


                @if(auth()->user()->hasRole('Super Admin'))
                    <!-- Sidebar Menu for Super Admin only -->
                        <li class="nav-item">
                            <a href="{{route('entity.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>
                                    {{__('messages.Entities')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('user.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    {{__('messages.Users')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('role.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    {{__('messages.Roles')}}
                                </p>
                            </a>
                        </li>
                        <!-- /.sidebar-menu -->
                    @endif

                </ul>
            </nav>

        </div>
        <!-- /.sidebar -->
    @endauth
</aside>
