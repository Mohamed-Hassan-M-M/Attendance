@extends('admin.layouts.dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attendance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home', $entity_id)}}">Home</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
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

                            <form id="filter">
                                @csrf
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <label>From</label>
                                        <input type="date" name="from" style="width: 100%" id="from" class="mb-5 mr-3 form-control" placeholder="Mm/Dd/Yyyy"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label>To</label>
                                        <input type="date" name="to" style="width: 100%" id="to" class="mb-5 mr-3 form-control" placeholder="Mm/Dd/Yyyy"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Employee ID</label>
                                        <input type="number" name="employee_id" style="width: 100%" id="employee_id" class="mb-5 form-control"/>
                                    </div>

                                </div>
                            </form>

                            <table id="table" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Company</th>
                                        <th>Department</th>
                                        <th>Date</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Actual In</th>
                                        <th>Actual Out</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
@section('script')
    <script>
        window.onload = function(){

            $("input[type=number]").bind('keyup', function(){
                if($('#from').val() && $('#to').val() && $('#employee_id').val() > 0)
                {
                    var form = $('#filter')[0];
                    var dataform = new FormData(form);
                    $.ajax({
                        type:'post',
                        url:'{{route('admin.attendance.getAttendance')}}',
                        data:dataform,
                        processData: false,
                        contentType: false,
                        success:function (data){

                            console.log(data.employee);
                            console.log(data.from_schedule);
                            console.log(data.from_actual);
                            console.log(data.to_schedule);
                            console.log(data.to_actual);
                            console.log(data.dates);

                                $('tbody').html('');
                                $.each(data.to_actual, function (index, emp) {
                                    $('tbody').append(`<tr>`+
                                                        `<td>`+
                                        (index+1) +
                                                        `</td>`+
                                                        `<td>`+
                                        data.employee.id +
                                                        `</td>`+
                                                        `<td>`+
                                        data.employee.firstname + data.employee.lastname +
                                                        `</td>`+
                                                        `<td>`+
                                        data.entity +
                                                        `</td>`+
                                                        `<td>`+
                                        data.department +
                                                        `</td>`+
                                                        `<td>`+
                                        data.dates[index] +
                                                        `</td>`+
                                                        `<td>`+
                                        data.from_schedule[index] +
                                                        `</td>`+
                                                        `<td>`+
                                        data.to_schedule[index] +
                                                        `</td>`+
                                                        `<td>`+
                                        data.from_actual[index] +
                                                        `</td>`+
                                                        `<td>`+
                                        data.to_actual[index] +
                                                        `</td>`+
                                                    `</tr>`);
                                });

                        },
                        error:function (reject){

                        }
                    })

                }
            });

        };
    </script>
@endsection
