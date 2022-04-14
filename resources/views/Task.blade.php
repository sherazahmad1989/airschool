@extends('layouts.theme')
@section('css')
    <link href="{{ asset('theme/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('theme/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List Of Task <a href="{{url('task/create')}}" class="btn btn-primary">Create</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Task
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>task</th>
                                            <th>TimeZone in Which created</th>
                                            <th>TimeZone in which user logedin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($task as $row)
                                            <tr class="gradeA">
                                                <td>{{ $row->task }}</td>
                                                <td>{{ $row->deadline }}</td>
                                                <td>{{ $row->current_date_time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection


@section('script')
    <!-- DataTables JavaScript -->
    <script src="{{ asset('theme/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/js/dataTables/dataTables.bootstrap.min.js') }}"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
