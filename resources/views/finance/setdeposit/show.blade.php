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
                        <h3 class="card-title">{{$setdeposit->title}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row d-flex justify-content-end m-2">
                        @if(auth()->user()->is_admin == '1')
                            <a href="{{ route('addmember.create', $setdeposit->id)}}" class="btn btn-info btn-sm ">Add member</a>
                        @endif
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Member name</th>
                                    <th>Pay</th>
                                    <th>Paid</th>
                                    <th>Status</th>
                                    @if(auth()->user()->is_admin === '1')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $data)
                                <tr>
                                    <td>{{$data->user->name}}</td>
                                    <td>{{$setdeposit->amount}}</td>
                                    <td>{{$data->totalPayments()}}</td>
                                    <td> 
                                        @if($data->status==1)                                        
                                            <p>active</p>
                                        @else
                                            <p>Inactive</p>                                        
                                        @endif
                                    </td>
                                    @if(auth()->user()->is_admin == '1')
                                    <td>
                                    
                                        <a href="{{route('payment', [$data->id, $setdeposit->id])}}" class="btn btn-sm btn-primary">Pay</a>
                                    
                                        <a href="{{route('pay.edit', $data->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    
                                        <a onclick="onDeleting('{{$data->id}}')" class="btn btn-sm btn-danger">delete</a>
                                    
                                    </td>
                                    @endif
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
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
    function onDeleting(id) {
        console.log(id);
        var url1= "{{ route('addmember.delete') }}";
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
                $.ajax({  
                        url: url1,
                        type:'POST', 
                        dataType:"json",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            "id": id, 
                        },
                        success:function(data){ 
                            //console.log(data.success);
                            swalWithBootstrapButtons.fire({
                                title: 'Deleted',
                                text: 'Succefully deleted.',
                                confirmButtonText: 'Ok',
                            }); 
                            location.reload();
                        },
                        error:function(xhr){ 
                            console.log(xhr);
                            //location.reload();
                        }
                    });

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