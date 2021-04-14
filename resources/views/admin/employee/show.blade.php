@extends('admin.layouts.dashboard')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.View')}} "{{ (app()->getLocale() == 'ar')? $employee->firstname_ar.' '.$employee->lastname_ar : $employee->firstname.' '.$employee->lastname }}"</h1>
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
                                <label for="firstname">{{__('messages.First Name en')}}</label>
                                <input type="text" class="form-control" disabled name="firstname" value="{{ $employee->firstname }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="firstname_ar">{{__('messages.First Name ar')}}</label>
                                <input type="text" class="form-control" disabled name="firstname" value="{{ $employee->firstname_ar }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="lastname">{{__('messages.Last Name en')}}</label>
                                <input type="text" class="form-control" disabled name="lastname" value="{{ $employee->lastname }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="lastname_ar">{{__('messages.Last Name ar')}}</label>
                                <input type="text" class="form-control" disabled name="lastname" value="{{ $employee->lastname_ar }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="department_id">{{__('messages.Department')}}</label>
                                <input type="text" class="form-control" disabled name="department_id" value="{{ (app()->getLocale() == 'ar')?$employee->department->name_ar : $employee->department->name}}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="address">{{__('messages.Address_en')}}</label>
                                <input type="text" class="form-control" disabled name="address" value="{{ $employee->address }}">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="address_ar">{{__('messages.Address_ar')}}</label>
                                <input type="text" class="form-control" disabled name="address" value="{{ $employee->address_ar }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="email">{{__('messages.Email')}}</label>
                                <input type="text" class="form-control" disabled name="email" value="{{ $employee->email }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="barcode">{{__('messages.Barcode')}}</label>
                                <input type="text" class="form-control" disabled name="barcode" value="{{ $employee->barcode }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="mobile">{{__('messages.Phone')}}</label>
                                <input type="text" class="form-control" disabled name="mobile" value="{{ $employee->mobile }}">
                            </div>
                        </div>

                        <div class="m-auto">
                            <a href="{{ route('admin.employee.index',$entity_id) }}" class="btn btn-primary">{{__('messages.Back')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
