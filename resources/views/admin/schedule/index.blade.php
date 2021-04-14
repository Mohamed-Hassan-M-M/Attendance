@extends('admin.layouts.dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.Schedules')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home', $entity_id)}}">{{__('messages.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.Schedules')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->

                        <div class="card-body">
                            <p>
                                <a href="{{route('admin.schedule.create',$entity_id)}}" class="btn btn-success">{{__('messages.Add New Schedule')}}</a>
                            </p>
                            <table id="table_id" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('messages.Employee ID')}}</th>
                                        <th>{{__('messages.Employee Name')}}</th>
                                        <th>{{__('messages.Company')}}</th>
                                        <th>{{__('messages.Department')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$employee->id}}</td>
                                        <td><a href="{{route('admin.schedule.show',[$entity_id,$employee->id])}}">{{ (app()->getLocale() == 'ar')? $employee->firstname_ar.' '.$employee->lastname_ar : $employee->firstname.' '.$employee->lastname }}</a></td>
                                        <td>{{(app()->getLocale() == 'ar')?$employee->entity->name_ar : $employee->entity->name}}</td>
                                        <td>{{(app()->getLocale() == 'ar')?$employee->department->name_ar : $employee->department->name}}</td>
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
            </div>
        </div>
    </section>

    <!-- /.content -->
@endsection
