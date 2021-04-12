@extends('admin.layouts.dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{__('messages.Home')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('messages.Home')}}</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                @if(isset($entities))
                    @foreach($entities as $entity)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <a href="{{route('admin.home',$entity->id)}}"><span class="info-box-text">@if(app()->getLocale() == 'ar'){{$entity->name_ar}}@else{{$entity->name}}@endif</span></a>
                                    <span class="info-box-number">{{$entity->employee->count()}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    @endforeach
                @else
                    @foreach($departments as $department)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <a href="{{route('admin.department.show',[url()->current()[strpos(url()->current(),'/admin')+7],$department->id])}}"><span class="info-box-text">@if(app()->getLocale() == 'ar'){{$department->name_ar}}@else{{$department->name}}@endif</span></a>
                                    <span class="info-box-number">{{$department->employee->count()}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    @endforeach
                @endif
            </div>
            <!-- /.row -->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
