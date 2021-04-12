@extends('admin.layouts.dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employees</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home', $entity_id)}}">Home</a></li>
                        <li class="breadcrumb-item active">Employees</li>
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
                                <a href="{{route('admin.employee.create',$entity_id)}}" class="btn btn-success">Add New Employee</a>
                            </p>
                            <table id="table_id" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><a href="{{route('admin.employee.show',[$entity_id,$employee->id])}}">{{$employee->firstname}} {{$employee->lastname}}</a></td>
                                        <td>{{$employee->mobile}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td><a href="{{route('admin.employee.edit',[$entity_id,$employee->id])}}" class="btn btn-success btn-xs"><i
                                                    class="fa fa-edit"></i>Edit</a></td>
                                        <td><a href="{{route('admin.employee.destroy',[$entity_id,$employee->id])}}" class="btn btn-danger btn-xs confirm-del"><i
                                                    class="fa fa-trash-o"></i>Delete</a></td>
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
