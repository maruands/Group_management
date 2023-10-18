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
                        <h3 class="card-title">Members</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row d-flex justify-content-end m-2">
                            @if($user->can('create user')) {
                                // User can create a user
                             
                                <a href="{{ url('register')}}" class="btn btn-info btn-sm ">New Member</a>
                            }
                            @endif
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mail</th>
                                    <th>Action</th>
                                </tr> 
                            </thead>
                            <tbody>
                                @foreach($members as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>
                                        @if(auth()->user()->is_admin === '1')
                                            <a href="{{ route('member.edit', $data->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        @endif
                                            <a class="btn btn-sm btn-primary">View</a>
                                        
                                            <a onclick="onDeleting('{{$data->id}}')" class="btn btn-danger btn-sm">Delete</a>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Mail</th>
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
<!--
<script src="{{ url('assets_admin/js/jquery-3.2.1.min.js') }}"></script>
-->
<script>
    function onDeleting(id) {
        console.log(id);
        var url1= "{{ route('members.destroy') }}";
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
<!-- Page specific script -->
@endsection