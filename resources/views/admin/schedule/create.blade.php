@extends('admin.layouts.dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.Create New Schedule')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home', $entity_id)}}">{{__('messages.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.Create')}}</li>
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
                        <h3 class="card-title">{{__('messages.Create Form')}}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-12">
                                <form id="msform" method="POST" action="{{route('admin.schedule.store',$entity_id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active">{{__('messages.Schedule Filter')}}</li>
                                        <li>{{__('messages.Select Employee')}}</li>
                                        <li>{{__('messages.Date')}}</li>
                                    </ul>
                                    <!-- fieldsets -->
                                    <fieldset>
                                        <h2 class="fs-title mb-5">{{__('messages.Schedule Filter')}}</h2>

                                        <div class="col-md-12 mb-4 mt-5 d-inline-block">
                                            <div class="form-group">
                                                <label for="departments" class="d-inline-block mr-4">{{__('messages.Department')}}</label>
                                                <select id="departments" name="department_id" required
                                                        class="form-control select2 select2-hidden-accessible d-inline-block" style="width: 50%;"
                                                        data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                    <option selected value="">{{__('messages.Choose Department')}}</option>
                                                    @foreach($departments as $department)
                                                        <option value="{{$department->id}}">{{(app()->getLocale() == 'ar')?$department->name_ar : $department->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <input type="button" name="next" class="next action-button first_next" style="display:none" value="{{__('messages.Next')}}"/>
                                    </fieldset>
                                    <fieldset>
                                        <h2 class="fs-title mb-5">{{__('messages.Select Employee')}}</h2>

                                        <table id="table" class="table table-bordered table-hover mt-5 mb-5">
                                            <thead>
                                                <tr>
                                                    <th width="50"><input id="select-all" type="checkbox"></th>
                                                    <th style="text-align: @if(app()->getLocale() == 'ar') right @else left @endif">{{__('messages.Name')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="all_emp">

                                            </tbody>
                                        </table>

                                        <input type="button" name="previous" class="previous action-button-previous" value="{{__('messages.Previous')}}"/>
                                        <input type="button" name="next" class="next action-button" value="{{__('messages.Next')}}"/>
                                    </fieldset>
                                    <fieldset>
                                        <h2 class="fs-title mb-4">{{__('messages.Date')}}</h2>

                                        <input type="date" id="from" class="mb-3" placeholder="Mm/Dd/Yyyy"/>
                                        <input type="date" id="to" class="mb-5" placeholder="Mm/Dd/Yyyy"/>

                                        <h2 class="fs-title mb-4">{{__('messages.Day and Time')}}</h2>

                                        <table id="table" class="table table-bordered table-hover mt-5 mb-5 text-center">
                                            <thead>
                                                <tr>
                                                    <th><input id="select-all2" type="checkbox" style="width: auto; display: none;" class="mr-2"><label for='select-all'>{{__('messages.Days')}}</label></th>
                                                    <th>{{__('messages.DayOff')}}</th>
                                                    <th>{{__('messages.CheckIn')}}</th>
                                                    <th>{{__('messages.CheckOut')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="all_days">

                                            </tbody>
                                        </table>

                                        <input type="button" name="previous" class="previous action-button-previous" value="{{__('messages.Previous')}}"/>
                                        <input type="submit" class="submit action-button" value="{{__('messages.Submit')}}"/>
                                    </fieldset>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
@section('styles')
    <style>
        /*custom font*/
        @import url(https://fonts.googleapis.com/css?family=Montserrat);

        /*form styles*/
        #msform {
            text-align: center;
            position: relative;
            margin-top: 30px;
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0px;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
            padding: 20px 30px;
            box-sizing: border-box;
            width: 80%;
            width: 100%;

            /*stacking fieldsets above each other*/
            position: relative;
        }

        /*Hide all except first fieldset*/
        #msform fieldset:not(:first-of-type) {
            display: none;
        }

        /*inputs*/
        #msform input, #msform textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 13px;
        }

        #msform input:focus, #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #007bff;
            outline-width: 0;
            transition: All 0.5s ease-in;
            -webkit-transition: All 0.5s ease-in;
            -moz-transition: All 0.5s ease-in;
            -o-transition: All 0.5s ease-in;
        }

        /*buttons*/
        #msform .action-button {
            width: 100px;
            background: #007bff;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button:hover, #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #007bff;
        }

        #msform .action-button-previous {
            width: 100px;
            background: #C5C5F1;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button-previous:hover, #msform .action-button-previous:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #C5C5F1;
        }

        /*headings*/
        .fs-title {
            font-size: 18px;
            text-transform: uppercase;
            color: #2C3E50;
            margin-bottom: 10px;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .fs-subtitle {
            font-weight: normal;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }

        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
        }

        #progressbar li {
            list-style-type: none;
            text-transform: uppercase;
            font-size: 9px;
            width: 33.33%;
            float: left;
            position: relative;
            letter-spacing: 1px;
        }

        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 24px;
            height: 24px;
            line-height: 26px;
            display: block;
            font-size: 12px;
            color: #333;
            background: white;
            border-radius: 25px;
            margin: 0 auto 10px auto;
        }

        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: white;
            position: absolute;
            left: -50%;
            top: 9px;
            z-index: -1; /*put it behind the numbers*/
        }

        #progressbar li:first-child:after {
            /*connector not needed before the first step*/
            content: none;
        }

        /*marking active/completed steps green*/
        /*The number of the step and the connector before it = green*/
        #progressbar li.active:before, #progressbar li.active:after {
            background: #007bff;
            color: white;
        }


        /* Not relevant to this form */
        .dme_link {
            margin-top: 30px;
            text-align: center;
        }
        .dme_link a {
            background: #FFF;
            font-weight: bold;
            color: #007bff;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 5px 25px;
            font-size: 12px;
        }

        .dme_link a:hover, .dme_link a:focus {
            background: #C5C5F1;
            text-decoration: none;
        }
    </style>
@endsection
@section('script')
<script src="{{ asset('scripts/process.js') }}"></script>
<script>
    $("#select-all").click(function(){
        $(".emp_check").prop('checked', $(this).prop('checked'));
    });
</script>
<script>
    window.onload = function(){
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(function(){
            if(animating) return false;
            animating = true;

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50)+"%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale('+scale+')'
                    });
                    next_fs.css({'left': left, 'opacity': opacity});
                },
                duration: 800,
                complete: function(){
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".previous").click(function(){
            if(animating) return false;
            animating = true;

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 50)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'left': left});
                    previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                },
                duration: 800,
                complete: function(){
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(document).on('change','#departments',function (e){
            var department_id = $(this).val();
            $.ajax({
                type:'get',
                url:'{{route('admin.schedule.getDepartmentEmployees')}}',
                data:{'department_id':department_id},
                success:function (data){
                    $('.first_next').show();
                    $.each(data.employees, function (index, emp) {
                        $('#all_emp').append(`<tr>`+
                                            `<td><input type="checkbox" class="emp_check" name="employee_id[]" value="${emp.id}"></td>`+
                                            `<td style="text-align: @if(app()->getLocale() == 'ar') right @else left @endif">@if(app()->getLocale() == 'ar') ${emp.firstname_ar} ${emp.lastname_ar} @else ${emp.firstname} ${emp.lastname} @endif</td>`+
                                        `</tr>`);
                    });
                },
                error:function (reject){
                }
            })
        });

        $(document).on('change','#to',function (e){

            var from = new Date($('#from').val());
            var to = new Date($(this).val());

            var timeDiff = Math.abs(to.getTime() - from.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            console.log(diffDays);
            do {
                $('#all_days').append(`<tr>`+
                                            `<td>`+
                                                `<span class="d-block">`+from.toLocaleDateString()+`</span>`+
                                                `<input type="checkbox" class="mr-2 day_check" checked name="day[]" style="width: auto;display: none;" value="${from.toLocaleDateString()}"> <span>`+getDayName(from.getDay())+`</span>`+
                                            `</td>`+
                                            `<td>`+
                                                `<span class="d-block">{{__("messages.DayOff")}}</span>`+
                                                `<input type="checkbox" name="day_off[]" value="${from.toLocaleDateString()}">`+
                                            `</td>`+
                                            `<td>`+
                                            `<input type="text" class="form-control" name="from[]" value="09:00 am">`+
                                            `</td>`+
                                            `<td>`+
                                            `<input type="text" class="form-control" name="to[]" value="05:00 pm">`+
                                            `</td>`+
                                        `</tr>`);
                from.setDate(from.getDate() + 1);
                diffDays--;
            }while (diffDays >= 0)

        });

    };
    function getDayName(daynumber){
        switch (daynumber) {
            case 0:
                return '{{__('messages.Sunday')}}';
            case 1:
                return '{{__('messages.Monday')}}';
            case 2:
                return '{{__('messages.Tuesday')}}';
            case 3:
                return '{{__('messages.Wednesday')}}';
            case 4:
                return '{{__('messages.Thursday')}}';
            case 5:
                return '{{__('messages.Friday')}}';
            case 6:
                return '{{__('messages.Saturday')}}';
        }
    }
</script>
@endsection
