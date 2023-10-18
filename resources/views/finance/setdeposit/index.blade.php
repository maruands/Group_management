@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                <div class="card mt-2">
                    <div class="card-header">
                        <h3 class="card-title">Deposits</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row d-flex justify-content-end m-2">
                        @if(auth()->user()->is_admin == 1)
                            <a href="{{ route('setdeposit.create')}}" class="btn btn-info btn-sm ">New Deposit</a>
                        @endif
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Contribution</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Status</th>
                                    @if(auth()->user()->is_admin === '1')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deposits as $data)
                                <tr>
                                    <td>{{$data->title}}</td>
                                    <td>{{$data->amount}}</td>
                                    <td>{{$data->start_date}}</td>
                                    <td>{{$data->end_date}}</td>
                                    <td>
                                        @if($data->status == 0)
                                            <span class='text-success'>Active</span>
                                        @else
                                            <span class="text-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                    @if(auth()->user()->is_admin === '1')
                                        <a href="{{route('setdeposit.edit', $data->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    @endif
                                        <a href="{{route('setdeposit.show', $data->id)}}" class="btn btn-sm btn-primary">View</a>
                                    @if(auth()->user()->is_admin === '1')
                                        <a class="btn btn-danger btn-sm">Delete</a>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>total</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- Page specific script -->
@endsection