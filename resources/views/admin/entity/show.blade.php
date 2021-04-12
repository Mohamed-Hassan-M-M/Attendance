@extends('admin.layouts.dashboard')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.View')}} "{{ (app()->getLocale() == 'ar')? $entity->name_ar : $entity->name }}"</h1>
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

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="name">{{__('messages.Name_en')}}</label>
                                <input type="text" class="form-control" disabled name="name" value="{{ $entity->name }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="name">{{__('messages.Name_ar')}}</label>
                                <input type="text" class="form-control" disabled name="name" value="{{ $entity->name }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="address">{{__('messages.Address_en')}}</label>
                                <input type="text" class="form-control" disabled name="address" value="{{ $entity->address }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="address">{{__('messages.Address_ar')}}</label>
                                <input type="text" class="form-control" disabled name="address" value="{{ $entity->address_ar }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">{{__('messages.Email')}}</label>
                                <input type="email" class="form-control" disabled name="email" value="{{ $entity->email }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone">{{__('messages.Phone')}}</label>
                                <input type="text" class="form-control" disabled name="phone" value="{{ $entity->phone }}">
                            </div>
                        </div>

                        <div class="m-auto">
                            <a href="{{ route('entity.index') }}" class="btn btn-primary">{{__('messages.Back')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
