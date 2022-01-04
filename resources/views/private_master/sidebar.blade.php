<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->

      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="{{ asset('store/admin2.png')}}">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="/profile" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="/logout" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="../">
                <img src="{{ asset('store/logo1.png') }}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item  class=" >
          <a class=" nav-link active " href="{{ route('dashboard') }}"> <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('commitment.index') }}">
              <i class="fas fa-credit-card text-warning"></i> Commitment
            </a>
          </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('loan.index') }}">
                    <i class="fas fa-piggy-bank text-success"></i> Loan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('transaction.transactionOutForm') }}">
                    <i class="fas fa-money-bill text-primary"></i> Expenses
                </a>
            </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('transaction.index') }}">
              <i class="ni ni-money-coins text-danger"></i> Transaction
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('saving.index') }}">
              <i class="ni ni-money-coins text-success"></i> Saving
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('summary.index') }}">
              <i class="ni ni-chart-bar-32 text-blue"></i> Summary
            </a>
          </li>
{{--          <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{ route('report.index') }}">--}}
{{--              <i class="ni ni-shop text-blue"></i>Report--}}
{{--            </a>--}}
{{--          </li>--}}
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Settings</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('setting') }}">
              <i class="ni ni-settings"></i> List Lookup
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
