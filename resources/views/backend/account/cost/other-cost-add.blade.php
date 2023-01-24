@extends('backend.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Other Cost</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Other Cost</li>
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

                                <h3 class="card-title">
                                    @if(isset($editData))
                                         Edit Cost
                                            @else
                                                Add Cost
                                            @endif

                                         </h3>



                                <a class="btn btn-success float-right btn-sm" href="{{route('accounts.cost.view')}}"><i class="fa fa-list"></i>Other Cost List</a>



                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label">Date</label>
                                        <input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" autocomplete="off" placeholder="Date">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <a class="btn btn-sm btn-success" id="search" style="margin-top: 29px;color: white">Search</a>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body" >



                                <form method="POST" action="{{(@$editData)?route('accounts.cost.update',$editData->id):route('accounts.cost.store')}}" id="myForm" enctype="multipart/form-data" >
                                    @csrf

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                        <label>Date</label>
                                            <input type="text" name="date" value="{{date('d-m-yy',strtotime(@$editData->date))}}" class="form-control singledatepicker" placeholder="Date" autocomplete="off">

                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Amount</label>
                                            <input type="text" name="amount" value="{{@$editData->amount}}" class="form-control ">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Image</label>
                                            <input type="file" name="image"  class="form-control " id="image">

                                        </div>
                                        <div class="col-md-4">
                                            <img id="showImage" src="{{(!empty($editData->image))?url('upload/cost_images/'.$editData->image):url('upload/no_img.png')}}" style="width:100px;height:110px;border:1px solid#000;">

                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Description</label>
                                            <textarea name="descripton" class="form-control" rows="4">{{@$editData->description}}</textarea>

                                        </div>
                                        <div class="form-group col-md-3">
                                            <button type="submit"class="btn btn-primary"> {{(@$editData)?"Update":"Submit"}}</button>

                                        </div>


                                    </div>


                                </form>


                            </div>




                        </div>


                    </section>


                </div>

            </div>
        </section>
        <!-- /.content -->

        <script type="text/javascript">
            $(document).ready(function () {


                $('#myForm').validate({
                    rules: {
                        "date": {
                            required: true,
                        },
                        "amount": {
                            required: true,
                        },
                        "description": {
                            required: true,

                        }
                    },

                    messages: {


                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });
            });
        </script>




    </div>














@endsection