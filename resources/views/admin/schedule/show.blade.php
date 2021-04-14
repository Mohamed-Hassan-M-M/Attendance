@extends('admin.layouts.dashboard')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>"{{(app()->getLocale() == 'ar')?$employee->firstname_ar.' '.$employee->lastname_ar : $employee->firstname.' '.$employee->lastname}}" {{__('messages.Working Hours')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home', $entity_id)}}">{{__('messages.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.View')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{__('messages.View Form')}}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="name">{{__('messages.Name')}}</label>
                                <input type="text" class="form-control" disabled name="name" value="{{ (app()->getLocale() == 'ar')?$employee->firstname_ar.' '.$employee->lastname_ar : $employee->firstname.' '.$employee->lastname}}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="department">{{__('messages.Department')}}</label>
                                <input type="text" class="form-control" disabled name="department" value="{{ (app()->getLocale() == 'ar')?$employee->department->name_ar : $employee->department->name}}">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-header font-weight-bold">{{__('messages.Working Hours')}}</div>

                                <div class="card-body">
                                    <table id="table" class="table table-bordered table-hover text-center">
                                        <thead>
                                        <tr>
                                            <th><input id="select-all2" type="checkbox" style="width: auto; display: none;" class="mr-2"><label for='select-all'>Days</label></th>
                                            <th>{{__('messages.DayOff')}}</th>
                                            <th>{{__('messages.CheckIn')}}</th>
                                            <th>{{__('messages.CheckOut')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($array_schedules as $schedule)
                                            <tr>
                                                <td>
                                                    <span class="d-block">{{$schedule->day}}</span>
                                                    <span>{{__("messages.$schedule->dayname")}}</span>
                                                </td>
                                                <td>
                                                    <span class="d-block">{{__('messages.DayOff')}}</span>
                                                    <input type="checkbox" @if($schedule->day_off == 1) checked @endif>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" disabled value="{{$schedule->from}}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" disabled value="{{$schedule->to}}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                        <div class="m-auto">
                            <a href="{{ route('admin.schedule.index',$entity_id) }}" class="btn btn-primary">{{__('messages.Back')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
