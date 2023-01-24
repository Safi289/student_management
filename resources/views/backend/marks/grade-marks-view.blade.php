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
                        <h1 class="m-0 text-dark">Manage Grade Point</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Grade Point</li>
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
                                <h3>Grade Point List
                                     @if($access_action->grade_point_act)
                                    <a class="btn btn-success float-right btn-sm" href="{{route('marks.grade.add')}}"><i class="fa fa-plus-circle"></i> Add Grade Point</a>
                                    @endif
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Grade Name</th>
                                        <th>Grade Point</th>
                                        <th>Start Marks</th>
                                        <th>End Marks</th>
                                        <th>Point Range</th>
                                        <th>Remarks</th>
                                         @if($access_action->grade_point_act)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allData as $key=>$value)
                                        <tr>
                                            <td>{{$key+1}}</td>

                                            <td>{{$value->grade_name}}</td>
                                            <td>{{number_format((float)$value->grade_point,2)}}</td>
                                            {{--<td>{{$value->grade_point}}</td>--}}
                                            <td>{{$value->start_marks}}</td>
                                            <td>{{$value->end_marks}}</td>
                                            <td>{{number_format((float)$value->grade_point,2)}} - {{($value->start_point=5)?
                                            (number_format((float)$value->grade_point,2)):(number_format((float)$value->grade_point,+1,2)-
                                            (float)0.01)

                                            }}


                                            </td>
                                            {{--<td>{{$value->start_point}} - {{$value->end_point}}</td>--}}
                                            <td>{{$value->remarks}}</td>
                                             @if($access_action->grade_point_act)
                                            <td>
                                                <a href="{{route('marks.grade.edit',$value->id)}}" class="btn btn-info btn-sm" title="Edit"> <i class="fa fa-edit"></i></a>

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