@extends('backend.layouts.master')

@section('content')
@php
    $access = App\Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    $access_submenu = App\Role_submenu::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    $access_action = App\Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    @endphp
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
                <div class="row">
                    <!-- Left col -->
                    <section class="col-md-12">
                        <!-- Custom tabs (Charts with tabs)-->


                        <div class="card">
                            <div class="card-header">
                                <h3>Student Fee List
                                     @if($access_action->students_fee_act)
                                    <a class="btn btn-success float-right btn-sm" href="{{route('accounts.fee.add')}}"><i class="fa fa-plus-circle"></i> Add/Edit Student Fee</a>
                                    @endif
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>ID No</th>
                                        <th>Name</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        <th>Fee Type</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allData as $key=>$data)
                                        <tr class="{{$data->id}}">
                                            <td>{{$key+1}}</td>

                                            <td>{{$data['student']['id_no']}}</td>
                                            <td>{{$data['student']['name']}}</td>
                                            <td>{{$data['year']['name']}}</td>
                                            <td>{{$data['student_class']['name']}}</td>
                                            <td>{{$data['fee_category']['name']}}</td>

                                            <td>{{$data->amount}}TK</td>
                                            <td>{{date('M Y',strtotime($data->date))}}</td>

                                        </tr>


                                    @endforeach


                                    </tbody>



                                </table>

                            </div><!-- /.card-body -->
                        </div>



                    </section>

                </div>

            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection