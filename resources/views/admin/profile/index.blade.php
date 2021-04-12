@extends("admin.layouts.dashboard")
@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('messages.Account')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="@if(auth()->user()->hasRole('Super Admin')) {{route('superAdmin.home')}} @else {{route('admin.home',auth()->user()->entity_id)}} @endif">{{__('messages.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.Profile')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row d-flex flex-row">
                            <div class="col-md-3 text-center p-5">
                                <a href="" id="overview">{{__('messages.Show Profile')}}</a><hr>
                                <a href="" id="edit">{{__('messages.Edit Profile')}}</a><hr>
                                <a href="" id="password">{{__('messages.Change Password')}}</a>
                            </div>
                            <div class="col-md-9 pt-5" id="content" style="@if(LaravelLocalization::getCurrentLocaleName() == 'Arabic') border-right:1px solid #2b3e505c; @else border-left:1px solid #2b3e505c; @endif color: rgba(0,0,0,.5);">
                                @include('admin.profile.overview')
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script>
        window.onload = function() {
            $(document).on('click','#overview',function (e){
                e.preventDefault();
                $.ajax({
                    type:'get',
                    url:'{{route('admin.profile.overview')}}',
                    data:{},
                    success:function (data){
                        if(data.status === true)
                        {
                            $('#content').html('');
                            $('#content').html(data.view);
                        }
                    },
                    error:function (reject){
                    }
                })
            });
            $(document).on('click','#edit',function (e){
                e.preventDefault();
                $.ajax({
                    type:'get',
                    url:'{{route('admin.profile.editProfile')}}',
                    data:{},
                    success:function (data){
                        if(data.status === true)
                        {
                            $('#content').html('');
                            $('#content').html(data.view);
                        }
                    },
                    error:function (reject){
                    }
                })
            });
            $(document).on('click','#updateProfile',function (e){
                e.preventDefault();
                var form = $('#updateform')[0];
                var dataform = new FormData(form);
                $.ajax({
                    type:'post',
                    url:'{{route('admin.profile.doEditProfile')}}',
                    data:dataform,
                    processData: false,
                    contentType: false,
                    success:function (data){
                        if(data.status === true)
                        {
                            $("#user_name_error").hide();
                            $("#email_error").hide();
                            $('#content').html('');
                            $('#content').html(data.view);
                        }
                    },
                    error:function (reject){
                        var response = $.parseJSON(reject.responseText);
                        $.each(response.errors, function(key, val){
                            $("#" + key + "_error").show();
                            $("#" + key + "_error").text(val[0]);
                        });
                    }
                })
            });
            $(document).on('click','#password',function (e){
                e.preventDefault();
                $.ajax({
                    type:'get',
                    url:'{{route('admin.profile.password')}}',
                    data:{},
                    success:function (data){
                        if(data.status === true)
                        {
                            $('#content').html('');
                            $('#content').html(data.view);
                        }
                    },
                    error:function (reject){
                    }
                })
            });
            $(document).on('click','#updatePassword',function (e){
                e.preventDefault();
                $('#old_password_error').hide();
                $('#old_password_error').text('');
                var form = $('#passwordform')[0];
                var dataform = new FormData(form);
                $.ajax({
                    type:'post',
                    url:'{{route('admin.profile.password.reset')}}',
                    data:dataform,
                    processData: false,
                    contentType: false,
                    success:function (data){
                        if(data.status === true)
                        {
                            location.reload();
                        }
                        if(data.status === false)
                        {
                            $("#password_error").hide();
                            $('#content').html('');
                            $('#content').html(data.view);
                            $('#old_password_error').show();
                            $('#old_password_error').text(data.error);
                        }
                    },
                    error:function (reject){
                        var response = $.parseJSON(reject.responseText);
                        $.each(response.errors, function(key, val){
                            $("#" + key + "_error").show();
                            $("#" + key + "_error").text(val[0]);
                        });
                    }
                })
            });
        };
    </script>
@endsection
