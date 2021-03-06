@extends('private_master.app')

@section('top-header')
<!-- Header -->

@include('sweetalert::alert')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
        <div class="row">
          <div class="col-lg-12 col-md-10">
          <h1><span class="text-white bg-warning">&nbsp;Saving Account&nbsp;</span></h1>
            <p class="text-white mt-0">Saving are separate with your Main Account to make sure you have place to track your saving.
            <br>All the transaction you make from Saving Account will relate with your Main Account.
            </p>
            <!-- <br><span class="text-white bg-success">&nbsp;Saving In&nbsp;</span> - transfer from your <span class="text-white bg-default">&nbsp;Main Account&nbsp;</span> to <span class="text-white bg-warning">&nbsp;Saving Account&nbsp;</span>
            <br><span class="text-white bg-danger">&nbsp;Saving Out&nbsp;</span> - transfer from <span class="text-white bg-warning">&nbsp;Saving Account&nbsp;</span> to your <span class="text-white bg-default">&nbsp;Main Account&nbsp;</span>  -->
          </div>
        </div>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Main Account</h5>
                      <span class="h2 font-weight-bold mb-0">RM {{ number_format( $user->userDetails->money , 2) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-default text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Saving Account</h5>
                      <span class="h2 font-weight-bold mb-0">RM {{ number_format( $user->userDetails->saving , 2) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">{{ \Carbon\Carbon::today()->format('M') }}-Saving In </h5>
                      <span class="h2 font-weight-bold mb-0">RM {{ number_format( $logIn , 2) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fa fa-arrow-up"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">{{ \Carbon\Carbon::today()->format('M') }}-Saving Out </h5>
                      <span class="h2 font-weight-bold mb-0">RM {{ number_format( $logOut , 2) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fa fa-arrow-down"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop

@section('content')
<div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
        <div class="card bg-gradient-default shadow">
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
            <div class="col">
                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                <h2 class="text-white mb-0">Saving Flow: {{ \Carbon\Carbon::today()->format('F Y') }}</h2>
            </div>
            <div class="col text-right">
                <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#savingInModal">SAVING IN</a>
                <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#savingOutModal">SAVING OUT</a>
            </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Chart -->
            <div class="chart">
            <!-- Chart wrapper -->
            <canvas id="myChart" class="chart-canvas"></canvas>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-xl-6 mb-7 mb-xl-0">
        <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0"><a href="/transaction">Latest Transaction</a></h3>
            </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Reason</th>
                <th scope="col">RM</th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
            @php
            $d = 1;
            @endphp
            @foreach($latestTransaction as $transaction)
            <tr>
                <th>{{ $d++ }}</th>
                <th scope="row">{{ $transaction->log_reason }}</th>
                <td><i class="fas {{ ($transaction->status == 1)? 'fa-arrow-up text-success' : 'fa-arrow-down text-warning' }} mr-3"></i>RM {{ number_format($transaction->log_rm,2) }}</td>
                <td>{{$transaction->created_at->diffForHumans()}}</td>
            </tr>
            @endforeach
            </tbody>
            </table>
        </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card shadow">
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
            <div class="col">
                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                <h2 class=" mb-0">Saving Account vs Main Account: {{ \Carbon\Carbon::today()->format('Y') }}</h2>
            </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Chart -->
            <div class="chart">
            <!-- Chart wrapper -->
            <canvas id="savingAndMoney" class="chart-canvas"></canvas>
            </div>
        </div>
        </div>
    </div>
    </div>

<!-- Saving in modal start -->
<div class="modal fade" id="savingInModal" tabindex="-1" role="dialog" aria-labelledby="savingInModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="post" action="{{ route('saving.savingIn') }}">
            @csrf
            <div class="modal-body" id="SavingIn">
                <h6 class="heading-small text-muted mb-4" >Saving IN</h6>
                <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Total In (RM)</label>
                        <input type="number" step="0.01" name="total" id="input-city" class="form-control form-control-alternative" placeholder="Total " autocomplete="off" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" >Reason</label>
                        <input type="text" name="reason" value="Saving" class="form-control form-control-alternative" placeholder="Reason" autocomplete="off" required id="autoReason">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Date : {{ \Carbon\Carbon::today()->format('d-m-Y') }}</label><br>
                        <small><span class="text-white bg-success">&nbsp;Saving In&nbsp;</span> - transfer from your <span class="text-white bg-default">&nbsp;Main Account&nbsp;</span> to <span class="text-white bg-warning">&nbsp;Saving Account&nbsp;</span></small>
                      </div>
                    </div>
                  </div>
                <hr class="my-1" />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Saving in modal end -->

      <!-- transaction out modal start -->
    <div class="modal fade" id="savingOutModal" tabindex="-1" role="dialog" aria-labelledby="savingOutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="post" action="{{ route('saving.savingOut') }}">
            @csrf
            <div class="modal-body" id="savingOut">
                <h6 class="heading-small text-muted mb-4">Transaction OUT</h6>

                <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Total In (RM)</label>
                        <input type="number" step="0.01" name="total" class="form-control form-control-alternative" placeholder="Total " autocomplete="off" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label">Reason</label>
                        <input type="text" name="reason" class="form-control form-control-alternative" placeholder="Reason" autocomplete="off" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label">Date : {{ \Carbon\Carbon::today()->format('d-m-Y') }}</label><br>
                        <small><span class="text-white bg-danger">&nbsp;Saving Out&nbsp;</span> - transfer from <span class="text-white bg-warning">&nbsp;Saving Account&nbsp;</span> to your <span class="text-white bg-default">&nbsp;Main Account&nbsp;</span></small>
                      </div>
                    </div>
                  </div>
                <hr class="my-1" />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Submit</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- transaction out modal end -->
@stop

@section('script')
<script>
  var e,ctx = document.getElementById('myChart').getContext('2d');
  $.ajax({
        url: "{{ route('savingFlow') }}",
        type: "GET",
        success : function (data) {
          var myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: data.month,
            datasets: [{
                label: 'Income',
                data: data.savingIn,
                borderColor: [
                  'rgba(45, 206, 137)'
                ],
                borderWidth: 3
            },{
                label: 'Expenses',
                data: data.savingOut,
                borderColor: [
                    'rgba(245, 54, 92)'
                ],
                borderWidth: 3
            }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          callback: function(e) {
                              if (!(e % 10))
                                  return "RM" + e
                          }
                      }
                  }]
              },
              elements: {
                line: {
                  tension : 0.15
                }
              }
          },
      });
        },
        error : function (data) {
            console.log(data);
        }
    });

</script>
<script>
  var e,chart2 = document.getElementById('savingAndMoney').getContext('2d');
  $.ajax({
        url: "{{ route('savingAndMoney') }}",
        type: "GET",
        success : function (data) {
          var savingAndMoney = new Chart(chart2, {
          type: 'pie',
          data: {
            labels: data.label,
            datasets: [{
                label: 'Income',
                data: data.value,
                backgroundColor: [
                  'rgba(23, 43, 77)',
                  'rgba(251, 99, 64)'
                ],
                borderWidth: 3
            }]
          },
          options: {
        legend: {
            display: true,
            labels: {
                fontColor: 'rgb(23, 43, 77)'
            }
        }
    }
      });
        },
        error : function (data) {
            console.log(data);
        }
    });

</script>
@stop
