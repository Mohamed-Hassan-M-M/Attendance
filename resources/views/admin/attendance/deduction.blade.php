@extends('admin.layouts.dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.Attendance Deduction')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home', $entity_id)}}">{{__('messages.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.Attendance Deduction')}}</li>
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
                                        <label>{{__('messages.From')}}</label>
                                        <input type="date" name="from" style="width: 100%" id="from" class="mb-5 mr-3 form-control" placeholder="Mm/Dd/Yyyy"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label>{{__('messages.To')}}</label>
                                        <input type="date" name="to" style="width: 100%" id="to" class="mb-5 mr-3 form-control" placeholder="Mm/Dd/Yyyy"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label>{{__('messages.Employee ID')}}</label>
                                        <input type="number" name="employee_id" style="width: 100%" id="employee_id" class="mb-5 form-control"/>
                                    </div>

                                </div>
                            </form>

                            <table id="table" class="table table-bordered table-hover text-center table-responsive" style="display: table;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('messages.Name')}}</th>
                                        <th>{{__('messages.Department')}}</th>
                                        <th>{{__('messages.Date')}}</th>
                                        <th>{{__('messages.From')}}</th>
                                        <th>{{__('messages.To')}}</th>
                                        <th>{{__('messages.Actual In')}}</th>
                                        <th>{{__('messages.Actual Out')}}</th>
                                        <th>{{__('messages.V.In')}}</th>
                                        <th>{{__('messages.V.Out')}}</th>
                                        <th>{{__('messages.Conformance')}}</th>
                                        <th>{{__('messages.Deduction Amount')}}</th>
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
                        url:'{{route('admin.attendance.getDeduction')}}',
                        data:dataform,
                        processData: false,
                        contentType: false,
                        success:function (data){

                                $('tbody').html('');
                                var deduct = '';
                                $.each(data.to_actual, function (index, emp) {
                                    if(data.from_schedule[index] == 'day off'){
                                        deduct = '<td>---</td></tr>';
                                    }
                                    else {
                                        deduct = `<td>`+
                                            `<input type="hidden" class="emp_id" value="${data.employee.id}">`+
                                            `<input type="hidden" class="date" value="${data.dates[index]}">`+
                                            `<input type="text" class="form-control deduction" value="${data.deduction[index]}">`+
                                            `</td>`+
                                            `</tr>`;
                                    }
                                    $('tbody').append(`<tr>`+
                                                        `<td>`+
                                        (index+1) +
                                                        `</td>`+
                                                        `<td>`+
                                        @if(app()->getLocale() == 'ar') data.employee.firstname_ar +' '+data.employee.lastname_ar + @else data.employee.firstname +' '+data.employee.lastname + @endif
                                                        `</td>`+
                                                        `<td>`+
                                        @if(app()->getLocale() == 'ar') data.department.name_ar + @else data.department.name + @endif
                                                        `</td>`+
                                                        `<td>`+
                                        `<div style="width: 100px">${data.dates[index]}</div>`+
                                                        `</td>`+
                                                        `<td>`+
                                        checkLang(data.from_schedule[index]) +
                                                        `</td>`+
                                                        `<td>`+
                                        checkLang(data.to_schedule[index]) +
                                                        `</td>`+
                                                        `<td>`+
                                        checkLang(data.from_actual[index]) +
                                                        `</td>`+
                                                        `<td>`+
                                        checkLang(data.to_actual[index]) +
                                                        `</td>`+
                                                        `<td>`+
                                        checkLang(data.v_in[index]) +
                                                        `</td>`+
                                                        `<td>`+
                                        checkLang(data.v_out[index]) +
                                                        `</td>`+
                                                        `<td>`+
                                        data.conformance[index] +
                                                        `</td>`+
                                                            deduct);
                                });

                        },
                        error:function (reject){

                        }
                    })

                }
            });
            $(document).on("keypress", '.deduction', function(e) {
                if(e.which == 13) {
                    if(!confirm('save deduction?')){
                        return;
                    }
                    $.ajax({
                        type:'get',
                        url:'{{route('admin.attendance.saveDeduction')}}',
                        data:{
                            'amount':$(this).val(),
                            'employee_id':$(this).prev().prev().val(),
                            'date':$(this).prev().val(),
                        },
                        success:function (data){
                            if(data.status == true){
                                alert("deduction saved.");
                            }
                        },
                        error:function (reject){

                        }
                    })
                }
            });

        };
    </script>
@endsection
