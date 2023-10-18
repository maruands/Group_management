@extends('layouts.app')

@section('content')
<!-- Main content -->
<div class="content">
      <div class="container-fluid ">
        <div class="row">
          <div class="col-lg-7">
              <div class="position-relative mb-4">
                  <canvas id="monthlyChart" width="400" height="200"></canvas>
              </div>
          </div>
          <div class="col-lg-5">
            <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Online Store Overview</h3>
                  <div class="card-tools">
                    <a href="#" class="btn btn-sm btn-tool">
                      <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-tool">
                      <i class="fas fa-bars"></i>
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                    <p class="text-success text-xl">
                      <i class="ion ion-ios-refresh-empty"></i>
                    </p>
                    <p class="d-flex flex-column text-right">
                      <span class="font-weight-bold">
                        <i class="text-success">Ksh. </i> {{$deposits->sum('amount')}}
                      </span>
                      <span class="text-muted">TOTAL CONTRIBUTION</span>
                    </p>
                  </div>
                  <!-- /.d-flex -->
                  <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                    <p class="text-warning text-xl">
                      <i class="ion ion-ios-cart-outline"></i>
                    </p>
                    <p class="d-flex flex-column text-right">
                      <span class="font-weight-bold">
                        <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                      </span>
                      <span class="text-muted">PAYMENT RATE</span>
                    </p>
                  </div>
                  <!-- /.d-flex -->
                  <div class="d-flex justify-content-between align-items-center mb-0">
                    <p class="text-danger text-xl">
                      <i class="ion ion-ios-people-outline"></i>
                    </p>
                    <p class="d-flex flex-column text-right">
                      <span class="font-weight-bold">
                        <i class="ion ion-android-arrow-down text-danger"></i> 1%
                      </span>
                      <span class="text-muted">BALANCE RATE</span>
                    </p>
                  </div>
                  <!-- /.d-flex -->
                </div>
              </div>
            </div>
        </div>
        <div class="row ">
          <!-- /.card -->
          <div class="col-lg-12">
                <div class="card mt-2">
                    <div class="card-header">
                      <div class="d-flex justify-content-between">
                        <h3 class="card-title">Deposits</h3>
                        <div class="row m-2">
                        
                            <a href="{{ route('setdeposit.create')}}" class="btn btn-info btn-sm ">New Deposit</a>
                        
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Contribution</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
                                    <td class="d-flex justify-content-between">
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
          
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<!-- Page specific script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">

                
                
                var monthly_data = {{ Js::from($total_month_data) }};

                

                var m_ctx = document.getElementById('monthlyChart');
                m_ctx = document.getElementById('monthlyChart').getContext('2d');
                const monthChart = new Chart(
                  m_ctx, {
                    type: 'bar',
                    data: {
                      labels: ['jan','feb','march','april','may','june','july','aug','sep','oct','nov','dec'],
                      datasets: [{
                          label: ['jan','feb','march'],
                          backgroundColor: 'rgb(100, 99, 232)',
                          borderColor: 'rgb(155, 199, 132)',
                          data: monthly_data,
                      }]
                    },
                    options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    }
                );
              
    </script>
@endsection