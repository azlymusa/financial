@extends('private_master.app')
@section('top-header')
    @include('sweetalert::alert')
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--text"><strong>Success!</strong> Now you can easily select Loan!</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                @if ($errors->any() || Session::has('error'))
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text"><strong>Error!</strong> {{ $error }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow border-0">
                <div class="card-header bg-danger border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0 text-white">List Loan</h3>
                        </div>
                        <div class="col text-right">
                            <a href="" data-toggle="modal" data-target="#addLoan" class="btn btn-sm btn-primary">+ Add New</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Loan</th>
                            <th scope="col">Total</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Monthly</th>
                            <th scope="col">Recurring day</th>
                            <th scope="col">Progress / Total Pay</th>
                            <th scope="col">Last Updated At</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($loans) > 0)
                            @foreach($loans as $data)
                                <tr>
                                    <th scope="row">{{ $data->title }}</th>
                                    <td>RM {{ number_format($data->total,2) }}</td>
                                    <td>{!! ($data->unlimit == 0) ? 'RM ' . number_format($data->balance,2) : '<span class="badge badge-pill badge-danger text-uppercase">Unlimit</span>' !!}</td>
                                    <td>RM {{ number_format($data->monthly,2) }}</td>
                                    <td>{{ $data->recurring_at }}</td>
                                    <td>
                                        @if($data->unlimit == 0)
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">{{ $data->getBalanceStatus()}}%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar {{ $data->progressbar_colour }}"
                                                             role="progressbar" aria-valuenow="{{ $data->getBalanceStatus()}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $data->getBalanceStatus()}}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="badge badge-pill badge-danger text-uppercase">Unlimit</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <button  class="btn btn-icon-only btn-success rounded-circle forceCompleteLoan" id="{{ $data->id }}" title="Complete">
                                            <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                                        </button>
                                        <button  class="btn btn-icon-only btn-warning rounded-circle updateLoan" title="Update" id="{{ $data->id }}">
                                            <span class="btn-inner--icon"><i class="ni ni-settings"></i></span>
                                        </button>
                                        <button  class="btn btn-icon-only btn-danger rounded-circle removeLoan" id="{{ $data->id }}" title="Delete">
                                            <span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th scope="row" colspan="5">No Loan Found</th>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-end mb-0">
                            {{$loans->links()}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header bg-success border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">List Loan Completed</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Loan</th>
                            <th scope="col">Total</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Monthly</th>
                            <th scope="col">Progress / Total Pay</th>
                            <th scope="col">Date Created</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($completed) > 0)
                            @foreach($completed as $data)
                                <tr>
                                    <th scope="row">{{ $data->title }}</th>
                                    <td>RM {{ number_format($data->total,2) }}</td>
                                    <td>{!! ($data->unlimit == 0) ? 'RM ' . number_format($data->balance,2) : '<span class="badge badge-pill badge-danger text-uppercase">Unlimit</span>' !!}</td>
                                    <td>RM {{ number_format($data->monthly,2) }}</td>
                                    <td>
                                        @if($data->unlimit == 0)
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">{{ $data->getBalanceStatus()}}%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar {{ $data->progressbar_colour }}" role="progressbar" aria-valuenow="{{ $data->getBalanceStatus()}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $data->getBalanceStatus()}}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="badge badge-pill badge-danger text-uppercase">Unlimit</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->created_at->diffForHumans() }}</td>
                                    <td>
                                        <button  class="btn btn-icon-only btn-danger rounded-circle removeLoan" id="{{ $data->id }}">
                                            <span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th scope="row" colspan="5">No Loan Found</th>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-end mb-0">{{$completed->links()}}</ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('private_content.loan.create')
    <!-- Loan update modal start -->
    @include('private_content.loan.edit')
    <!-- Loan update modal end -->
@stop
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $( document ).ready(function() {


            $('.forceCompleteLoan').click(function(){
                var id = $(this).attr("id");
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure to force complete?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Force Complete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        redirect('{{route('loan.complete')}}', {
                                "_token": "{{ csrf_token() }}",
                                id:id
                            },
                        );
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Cancel Force Completed',
                            'error'
                        )
                    }
                })

            });

            $(".updateLoan").click(function(){
                var id = $(this).attr("id");

                $.ajax({
                    url:"{{route('LoantList')}}",
                    method:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        id:id
                    },
                    dataType:"json",
                    success:function(data){
                        $('#forTitle').val(data.title);
                        $('#forTotal').val(data.total);
                        $('#forBalance').val(data.balance);
                        $('#forMonthly').val(data.monthly);
                        $('#forId').val(data.id);
                        $('#forRecurring').val(data.recurring_at);
                        $('#updateLoanModal').modal('show');

                        $('#updateTotal').show()
                        $('#updateBalance').show()
                        $('#updateTotal input').prop('required', true);
                        $('#updateBalance input').prop('required', true);
                    }
                });
            });

            $(".removeLoan").click(function(){
                var id = $(this).attr("id");
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
                    if (result.value) {
                        redirect('{{route('loan.delete')}}', {
                                "_token": "{{ csrf_token() }}",
                                id:id
                            },
                        );
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Cancel Delete',
                            'error'
                        )
                    }
                })
            });

            function redirect(url, data) {
                var form = document.createElement('form');
                document.body.appendChild(form);
                form.method = 'post';
                form.action = url;
                for (var name in data) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    input.value = data[name];
                    form.appendChild(input);
                }
                form.submit();
            }
        });
    </script>
@stop
