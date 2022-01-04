@extends('private_master.app')

@section('top-header')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">

        </div>
      </div>
    </div>
@stop

@section('content')
@include('sweetalert::alert')
<!-- Page content -->
      <div class="row">
        <div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-body pt-0 pt-md-4">
                <form method="post" action="{{ route('transaction.transactionOut') }}">
                    @csrf
                    <div class="modal-body" id="transactionOut">
                        <h6 class="heading-small text-muted mb-4"Expenses</h6>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Category</label>
                                    <select class="form-control form-control-alternative" required name="kategori_id">
                                        <option value="">Select</option>
                                        @foreach($expensesList as $expenses)
                                            <option value="{{ $expenses->id }}">{{ $expenses->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
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
                                    <label class="form-control-label">Date : {{ \Carbon\Carbon::today()->format('d-m-Y') }}</label>
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
      </div>
@stop

@section('script')
<script>
    $(document).ready(function(){
      var strokeCount = 0;
      var total;
      $('#password').keyup(function(){
        total = $(this).val().length;
        if(total >= 8){
          $('#msgMinPass').text('Good').removeClass('text-danger').addClass('text-success');
        } else {
          $('#msgMinPass').text('Minimum password at least 8 character').removeClass('text-success').addClass('text-danger');
        }
      });
    });

    </script>
@stop
