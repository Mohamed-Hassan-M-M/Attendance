@extends('admin.layouts.dashboard')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.Create New User')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('superAdmin.home')}}">{{__('messages.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.Create')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <form method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
        @csrf
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{__('messages.Create Form')}}</h3>

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
                                    <input type="text" class="form-control" name="name" placeholder="{{__('messages.Enter Name')}}">
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email">{{__('messages.Email')}}</label>
                                    <input type="email" class="form-control" name="email" placeholder="{{__('messages.Email address')}}">
                                    @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="password">{{__('messages.Password')}}</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="{{__('messages.Enter Password')}}">
                                    @error('password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="password_confirmation">{{__('messages.Password Confirmation')}}</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="{{__('messages.Enter Password again')}}">
                                </div>
                            </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="entity_id">{{__('messages.Entity')}}</label>
                                        <select name="entity_id" class="form-control select2 select2-hidden-accessible"
                                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true"
                                            id="entity_id">
                                            <option value="">{{__('messages.choose')}}</option>
                                            @foreach($entities as $entity)
                                            <option value="{{$entity->id}}">{{ (app()->getLocale() == 'ar')? $entity->name_ar : $entity->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                            <div class="col-md-9 mb-3">
                                <div class="form-group">
                                    <label for="role">{{__('messages.Role List')}}</label>
                                    <br>
                                    <div class="row">
                                        @foreach($roles as $role)
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="radio" value="{{$role->id}}" class="mr-2"
                                                        name="role">{{$role->name}}
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('role')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="m-auto">
                                <button class="btn btn-primary">{{__('messages.Create')}}</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

@endsection
