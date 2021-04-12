@extends('admin.layouts.dashboard')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View "{{ $department->name }}"</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home', $entity_id)}}">Home</a></li>
                        <li class="breadcrumb-item active">View</li>
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
                    <h3 class="card-title">View Form</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" disabled name="name" value="{{ $department->name }}">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-header font-weight-bold">Employees</div>

                                <div class="card-body">
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
                                        @foreach($department->employee as $employee)
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

                        <div class="m-auto">
                            <a href="{{ route('admin.department.index',$entity_id) }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
