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
@stop

@section('script')

@stop
