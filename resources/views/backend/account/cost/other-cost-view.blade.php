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
                <div class="row">
                    <!-- Left col -->
                    <section class="col-md-12">
                        <!-- Custom tabs (Charts with tabs)-->


                        <div class="card">
                            <div class="card-header">
                                <h3>Other Cost List
                                     @if($access_action->other_cost_act)
                                    <a class="btn btn-success float-right btn-sm" href="{{route('accounts.cost.add')}}"><i class="fa fa-plus-circle"></i> Add Other Cost</a>
                                    @endif
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        @if($access_action->other_cost_act)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allData as $key=>$data)
                                        <tr class="{{$data->id}}">
                                            <td>{{$key+1}}</td>
                                            <td>{{date('d-m-yy',strtotime($data->date))}}</td>
                                            <td>{{$data->amount}}TK</td>
                                            <td>{{$data->description}}TK</td>
                                            <td>
                                                <img  src="{{(!empty($data->image))?url('upload/cost_images/'.$data->image):url('upload/no_img.png')}}" style="width:70px;height:80px;border:1px solid#000;">
                                            </td>
                                            @if($access_action->other_cost_act)

                                            <td>
                                                <a title="Edit" class="btn btn-sm btn-primary" href="{{route('accounts.cost.edit',$data->id)}}"><i class="fa fa-edit"></i></a>


                                            </td>
                                            @endif


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