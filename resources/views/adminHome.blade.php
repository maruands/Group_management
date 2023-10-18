@extends('layouts.app')
   
@section('content')
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Yearly Report</h3>
                </div>
              </div>
              <div class="card-body"> 
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">ksh. {{$GrandTotal}}</span>
                    <span>Grand Total amount</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> {{$total_percentage}}%
                    </span>
                    <span class="text-muted">Since last year</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="myChart" width="400" height="200"></canvas>
                </div>
                
                
                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Week
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last Week
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Members</h3>
                <div class="card-tools">
                  
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Names</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>More</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($watu as $dt)
                  <tr>
                    <td>
                      {{$dt->name}}
                    </td>
                    <td>{{$dt->email}}</td>
                    @if($dt->is_admin == 1)
                    <td>
                      Admin
                    </td>
                    @else
                    <td>
                      Member
                    </td>
                    @endif
                    <td>
                      <a href="#" class="btn btn-info btn-sm">
                        View
                      </a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Monthly Report</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Ksh. {{$t_this_m}}</span>
                    <span>Sales Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> {{$total_m_per}}% 
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="monthlyChart" width="400" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card ">
              <div class="card-header my-4 border-1">
                <h3 class="card-title">Performance Overview</h3>
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
                      <i class="ion ion-android-arrow-up text-success"></i> 12%
                    </span>
                    <span class="text-muted">CONVERSION RATE PER YEAR</span>
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
                    <span class="text-muted">CONVERSION RATE PER MONTH</span>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center mb-0">
                  <p class="text-danger text-xl">
                    <i class="ion ion-ios-people-outline"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                       1
                    </span>
                    <span class="text-muted">REGISTERED MEMBERS</span>
                  </p>
                </div>
                <!-- /.d-flex -->
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript">
  
                   
                    var users =  {{ Js::from($data) }};
                    var monthly_data = {{ Js::from($total_month_data) }};

                    var ctx = document.getElementById('myChart');
                    ctx = document.getElementById('myChart').getContext('2d');
                    
                    const myChart = new Chart(
                        ctx, {
                        type: 'bar',
                        data: {
                          labels: ['2021','2022','2023'],
                          datasets: [{
                              label: ['2021','2022','2023'],
                              backgroundColor: 'rgb(255, 99, 132)',
                              borderColor: 'rgb(255, 99, 132)',
                              data: users,
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