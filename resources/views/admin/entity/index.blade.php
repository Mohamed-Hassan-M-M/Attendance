@extends('admin.layouts.dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.Entities')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('superAdmin.home')}}">{{__('messages.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.Entities')}}</li>
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
                                <a href="{{url('entity/create')}}" class="btn btn-success">{{__('messages.Add New Entity')}}</a>
                            </p>
                            <table id="table_id" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('messages.Name')}}</th>
                                        <th>{{__('messages.Phone')}}</th>
                                        <th>{{__('messages.Edit')}}</th>
                                        <th>{{__('messages.Delete')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($entities as $entity)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><a href="{{url('entity/'. $entity->id)}}">@if(app()->getLocale() == 'ar'){{$entity->name_ar}}@else{{$entity->name}}@endif</a></td>
                                        <td>{{$entity->phone}}</td>
                                        <td><a href="{{url("entity/{$entity->id}/edit")}}" class="btn btn-success btn-xs"><i
                                                    class="fa fa-edit"></i> {{__('messages.Edit')}}</a></td>
                                        <td>
                                            <form action="{{url("entity/{$entity->id}")}}" method="post">
                                                <button class="btn btn-danger btn-xs confirm-del"><i
                                                        class="fa fa-trash"></i> {{__('messages.Delete')}}</button>
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </td>

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
@section('styles')
<link rel="stylesheet" href="{{asset('datepicker/dist/datepicker.min.css')}}">
@endsection
@section('script')
<script src="{{asset('datepicker/dist/datepicker.min.js')}}"></script>
<script>
    $('[data-toggle="datepicker"]').datepicker();
</script>
@endsection
