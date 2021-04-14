@extends('admin.layouts.dashboard')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.Update')}} "{{ (app()->getLocale() == 'ar')? $employee->firstname_ar.' '.$employee->lastname_ar : $employee->firstname.' '.$employee->lastname }}"</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home', $entity_id)}}">{{__('messages.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.Update')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <form id="form" method="POST" action="{{ route('admin.employee.update',[$entity_id,$employee->id]) }}" enctype="multipart/form-data">
        @csrf
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{__('messages.Update Form')}}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row">
                            <input type="hidden" name="id" value="{{$employee->id}}">

                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="department_id">{{__('messages.Department')}}</label>
                                    <select id="departments" name="department_id" required
                                            class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option selected value="">{{__('messages.Choose Department')}}</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{$department->id==$employee->department_id ? 'selected':''}}>{{(app()->getLocale() == 'ar')? $department->name_ar : $department->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="firstname">{{__('messages.First Name en')}}</label>
                                    <input type="text" value="{{$employee->firstname}}" class="form-control" required name="firstname"
                                           placeholder="{{__('messages.Enter First Name en')}}">
                                    @error('firstname')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="firstname_ar">{{__('messages.First Name ar')}}</label>
                                    <input type="text" value="{{$employee->firstname_ar}}" class="form-control" required name="firstname_ar"
                                           placeholder="{{__('messages.Enter First Name ar')}}">
                                    @error('firstname_ar')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="lastname">{{__('messages.Last Name en')}}</label>
                                    <input type="text" value="{{$employee->lastname}}" class="form-control" required name="lastname"
                                           placeholder="{{__('messages.Enter Last Name en')}}">
                                    @error('lastname')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="lastname_ar">{{__('messages.Last Name ar')}}</label>
                                    <input type="text" value="{{$employee->lastname_ar}}" class="form-control" required name="lastname_ar"
                                           placeholder="{{__('messages.Enter Last Name ar')}}">
                                    @error('lastname_ar')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="mobile">{{__('messages.Phone')}}</label>
                                    <input type="text" value="{{$employee->mobile}}" class="form-control" required name="mobile"
                                           placeholder="{{__('messages.Enter Phone')}}">
                                    @error('mobile')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="barcode">{{__('messages.Barcode')}}</label>
                                    <input type="text" value="{{$employee->barcode}}" class="form-control" required name="barcode"
                                           placeholder="{{__('messages.Enter Barcode')}}">
                                    @error('barcode')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email">{{__('messages.Email')}}</label>
                                    <input type="email" value="{{$employee->email}}" class="form-control" name="email"
                                           placeholder="{{__('messages.Email address')}}">
                                    @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="address">{{__('messages.Address_en')}}</label>
                                    <input type="text" value="{{$employee->address}}" class="form-control" required name="address"
                                           placeholder="{{__('messages.Enter Address en')}}">
                                    @error('address')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="address_ar">{{__('messages.Address_ar')}}</label>
                                    <input type="text" value="{{$employee->address_ar}}" class="form-control" required name="address_ar"
                                           placeholder="{{__('messages.Enter Address ar')}}">
                                    @error('address_ar')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="m-auto">
                                <button class="btn btn-primary">{{__('messages.Update')}}</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

@endsection
