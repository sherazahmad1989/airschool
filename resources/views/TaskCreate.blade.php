@extends('layouts.theme')

@section('css')
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form action="{{url('task')}}" method="post">
                    {{ csrf_field() }}
                    <div class="col-lg-12 col-md-12">
                        <label>Task</label>

                        <textarea class="form-control" name="task"></textarea>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label>Deadline</label>
                        <input class="form-control" type="datetime-local" name="deadline" placeholder="Task" />

                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label>Type</label>

                        <select name="is_local" class="form-control">
                            <option value="local">local</option>
                            <option value="public">public</option>
                        </select>

                    </div>
                    <div class="col-lg-12 col-md-12">
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection

@section('scripts')
@endsection
