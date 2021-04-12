@extends('admin.layouts.dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.Create New Entity')}}</h1>
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
    <form id="form" method="POST" action="{{route('entity.store')}}" enctype="multipart/form-data">
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
                                    <label for="name">{{__('messages.Name_en')}}</label>
                                    <input type="text" class="form-control" required name="name"
                                           placeholder="{{__('messages.Enter Name en')}}">
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name_ar">{{__('messages.Name_ar')}}</label>
                                    <input type="text" class="form-control" required name="name_ar"
                                           placeholder="{{__('messages.Enter Name ar')}}">
                                    @error('name_ar')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="address">{{__('messages.Address_en')}}</label>
                                    <input type="text" class="form-control" required name="address"
                                           placeholder="{{__('messages.City, Street, Building, Floor en')}}">
                                    @error('address')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="address_ar">{{__('messages.Address_ar')}}</label>
                                    <input type="text" class="form-control" required name="address_ar"
                                           placeholder="{{__('messages.City, Street, Building, Floor ar')}}">
                                    @error('address_ar')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email">{{__('messages.Email')}}</label>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="{{__('messages.Email address')}}">
                                    @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="phone">{{__('messages.Phone')}}</label>
                                    <input type="text" class="form-control" required name="phone"
                                           placeholder="{{__('messages.Phone Number')}}">
                                    @error('phone')
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
