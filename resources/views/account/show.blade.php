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
                        <h3 class="card-title">Accounts</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row d-flex justify-content-end m-2">
                            <a href="{{ route('account.index')}}" class="btn btn-secondary btn-sm mr-5">Back </a>
                            <a href="{{ route('add', $user->id)}}" class="btn btn-success btn-sm ">Add </a>
                        </div>
                        <div class="row">
                            <div class="card col-12">
                                <div class="card-header d-flex justify-content-between">
                                    <h3 class=" mb-2">
                                        {{$user->name}}
                                    </h3>
                                    
                                    <h5 class="">
                                       Total balance: {{$user->totalacounts()}}
                                    </h5>
                                    
                                </div>
                                <div class="card-body">
                                    @foreach($user->account as $data)
                                    <div class="row d-flex justify-content-between p-2 border">
                                        <span> Ksh. {{ $data->amount}} /=</span> 
                                        <span>{{$data->created_at}}</span>
                                        <span>
                                            <a href="{{ route('account.edit', $user->id) }}" class="btn btn-sm btn-primary text-black">Edit</a>
                                            <a onclick="onDeleting('{{$data->id}}')" class="btn btn-danger btn-sm">Delete</a>
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
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
<script>
    function onDeleting(id) {
        console.log(id);
    
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
            )
        }
        })
    }
</script>

@endsection