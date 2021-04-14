@extends('admin.layouts.dashboard')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.Users')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('superAdmin.home')}}">{{__('messages.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.Users')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{route('user.create')}}" class="btn btn-success">{{__('messages.Add New User')}}</a>
                        <br>
                        <br>
                        <table id="table_id" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('messages.Name')}}</th>
                                    <th>{{__('messages.Email')}}</th>
                                    <th>{{__('messages.Role')}}</th>
                                    <th>{{__('messages.Edit')}}</th>
                                    <th>{{__('messages.Delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <span class="btn btn-success btn-xs">{{$user->getRoleNames()[0]}}</span>
                                    </td>
                                    <td>
                                        @if(!$user->hasRole('Super Admin'))
                                        <a href="{{url("user/{$user->id}/edit")}}" class="btn btn-success btn-xs"><i
                                                class="fa fa-edit"></i> {{__('messages.Edit')}}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$user->hasRole('Super Admin'))
                                        <form action="{{url("user/{$user->id}")}}" method="post">
                                            <button class="btn btn-danger btn-xs confirm-del"><i
                                                    class="fa fa-trash"></i> {{__('messages.Delete')}}</button>
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
