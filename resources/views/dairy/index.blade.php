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
                        <h3 class="card-title">Dairy</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row d-flex justify-content-end m-2">
                            <a href="{{ route('dairy.create')}}" class="btn btn-info btn-sm ">New Item</a>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>B. price</th>
                                    <th>S. price</th>
                                    <th>Expence</th>
                                    <th>Collected</th>
                                    <th>Total Buying</th>
                                    <th>Total Selling</th>
                                    <th>Profit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dairies as $data)
                                <tr>
                                    <td>{{$data->date}}</td>
                                    <td>{{$data->Item}}</td>
                                    <td>{{$data->quantity}}</td>
                                    <td>{{$data->buying_price}}</td>
                                    <td>{{$data->selling_price}}</td>
                                    <td>{{$data->expendicture}}</td>
                                    <td>{{$data->receive_amount}}</td>
                                    <td>{{$data->quantity * $data->buying_price}}</td>
                                    <td>{{$data->quantity * $data->selling_price}}</td>
                                    <td>{{($data->quantity * $data->selling_price) - ($data->quantity * $data->buying_price) - $data->expendicture}}</td>
                                    <td>
                                        <a href="{{route('dairy.edit', $data->id)}}" class="btn btn-sm btn-info">Edit</a>
                                        <a class="btn btn-sm btn-primary">View</a>
                                        <a onclick="onDeleting('{{$data->id}}')" class="btn btn-danger btn-sm">Delete</button> delete</a>
                                </tr>
                                @endforeach
                            </tbody>
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
<!-- Page specific script -->
@endsection