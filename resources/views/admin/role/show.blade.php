@extends('admin.layouts.dashboard')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.View')}} "{{ $role->name }}"</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('superAdmin.home')}}">{{__('messages.Home')}}</a></li>
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

                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="name">{{__('messages.Name')}}</label>
                                <input type="text" class="form-control" disabled name="name" value="{{ $role->name }}"
                                    placeholder="{{__('messages.Enter Name')}}">
                            </div>
                        </div>

                        <div class="col-md-12 row">
                            @php
                            $myPermissions = $role->permissions->pluck('id')->toArray();
                            @endphp

                            @foreach ($permissions as $permission)
                            <p class="col-md-3">
                                <label>
                                    <input type="checkbox" name="permissions[]"
                                        {{ in_array($permission->id, $myPermissions )? 'checked' : '' }}
                                        value="{{ $permission->id }}">
                                    &nbsp;
                                    <span class="mb-1">
                                        {{ __("messages.$permission->name") }}
                                    </span>
                                </label>
                            </p>
                            @endforeach
                        </div>

                        <div class="m-auto">
                            <a href="{{ route('role.index') }}" class="btn btn-primary">{{__('messages.Back')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
