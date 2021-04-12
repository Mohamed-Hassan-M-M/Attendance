@extends('admin.layouts.dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.Create New Role')}}</h1>
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
    <form id="form" method="POST" action="{{route('role.store')}}" enctype="multipart/form-data">
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
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="name">{{__('messages.Name')}}</label>
                                    <input type="text" class="form-control" required name="name"
                                        placeholder="{{__('messages.Enter Name')}}">
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-1">
                                <div class="form-group">
                                    <label for="permissions_list[]">{{__('messages.Permission List')}}</label>
                                    <br>
                                    <input id="select-all" type="checkbox"> <label for='select-all'> {{__('messages.Select All')}} </label>
                                    <br>
                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                        <p class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="permissions[]"
                                                    value="{{ $permission->id }}">
                                                &nbsp;
                                                <span class="mb-1">
                                                    {{__("messages.$permission->name")}}
                                                </span>

                                            </label>
                                        </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-auto">

                            <button class="btn btn-primary">{{__('messages.Create')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
    integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
    crossorigin="anonymous"></script>
<script src="{{ asset('scripts/process.js') }}"></script>
<script>
    $("#select-all").click(function(){
      $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
    });
</script>
@endsection
