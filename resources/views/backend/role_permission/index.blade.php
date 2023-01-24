@extends('backend.layouts.master')

@section('content')

 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Roles</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Roles</li>
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
                                <h3>Role List

                
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-hover">

                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Role</th>
                                       
                                        
                                        <th>Change Permission</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($roles as $row)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{$row->name}}</td>
                                        
                                       
                                       
                                        <td>
                                         <a title="Edit" class="btn btn-sm btn-primary" href="{{ route('permission', $row->id) }}"><i class="fa fa-edit"></i></a>
                                           

                                            <!-- Modal -->
                                        




                                        </td>

                                    </tr>
                                    	@php($i++)
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