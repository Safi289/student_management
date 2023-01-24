@extends('backend.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Students Fee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Students Fee</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <!-- /.row -->
                <!-- Main row -->
                <div class="row" >
                    <!-- Left col -->
                    <section class="col-md-12">
                        <!-- Custom tabs (Charts with tabs)-->




                        <div class="card">
                            <div class="card-header">

                                <h3 class="card-title">Add/Edit Student Fee</h3>



                                <a class="btn btn-success float-right btn-sm" href="{{route('accounts.fee.view')}}"><i class="fa fa-list"></i>Student Fee List</a>



                            </div><!-- /.card-header -->
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="year_id">Select Year</label>
                                        <select name="year_id" id="year_id" class="form-control select2bs4">
                                            <option value="">Select Year</option>
                                            @foreach($years as $year)
                                                <option value="{{$year->id}}">{{$year->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class=" col-md-3">
                                        <label for="class_id">Select Class</label>
                                        <select name="class_id" id="class_id" class="form-control select2bs4">
                                            <option value="">Select Class</option>
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class=" col-md-3">
                                        <label for="fee_category_id">Fee Category</label>
                                        <select name="fee_category_id" id="fee_category_id" class="form-control select2bs4">
                                            <option value="">Select Fee </option>
                                            @foreach($fee_categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Date</label>
                                        <input type="text" name="date" id="date" class="form-control singledatepicker" placeholder="DD-MM-YYYY">

                                    </div>
                                    <div class="form-group col-md-3">
                                        <a id="search" class="btn btn-primary" name="search">Search</a>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div id="DocumentResults"></div>
                                <script id="document-template" type="text/x-handlebars-template">
                                    <form action="{{route('accounts.fee.store')}}" method="post">
                                        @csrf
                                        <table class="table-sm table-bordered table-striped" style="width: 100%">
                                            <thead>
                                            <tr>
                                                @{{{thsource}}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @{{#each this}}
                                            <tr>
                                                @{{{tdsource}}}
                                            </tr>
                                            @{{/each }}
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary btn-sm" style="margin-top:10px;">Submit</button>
                                    </form>
                                </script>
                            </div>






                        </div>



                    </section>


                </div>

            </div>
        </section>
        <!-- /.content -->

        <script type="text/javascript">
            $(document).on('click','#search',function () {

                var year_id=$('#year_id').val();
                var class_id=$('#class_id').val();
                var fee_category_id=$('#fee_category_id').val();
                var date=$('#date').val();
                $('.notifyjs-corner').html('');

                if(year_id==''){
                    $.notify("Year required",{globalPosition:'top-right',className:'error'});
                    return false;
                }
                if(class_id=='') {
                    $.notify("Class required", {globalPosition: 'top-right', className: 'error'});
                    return false;
                }
                if(fee_category_id=='') {
                    $.notify("Fee Category required", {globalPosition: 'top-right', className: 'error'});
                    return false;
                }
                if(date=='') {
                    $.notify("Date required", {globalPosition: 'top-right', className: 'error'});
                    return false;
                }
                $.ajax({
                    url:"{{route('accounts.fee.getstudent')}}",
                    type:"GET",
                    data:{'year_id':year_id,'class_id':class_id,'fee_category_id':fee_category_id,'date':date},
                    beforeSend:function () {

                    },
                    success:function (data){
                        var source=$("#document-template").html();
                        var template=Handlebars.compile(source);
                        $('#roll-generate').removeClass('d-none');
                        var html=template(data);
                        $('#DocumentResults').html(html);
                        $('[data-toggle="tooltip"]').tooltip();



                    }

                });

            });

        </script>



    </div>














@endsection