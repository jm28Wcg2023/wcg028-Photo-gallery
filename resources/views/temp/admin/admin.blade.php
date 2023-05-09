@extends('temp.master')

@section('uplinks')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="templete/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

@endsection

@section('sidenav')
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{route('admin')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link" href="{{route('market')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-shop"></i></div>
                Market
            </a>
            <div class="sb-sidenav-menu-heading">Tables</div>
            <a class="nav-link" href="{{route('userlist')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Users
            </a>
            <a class="nav-link" href="{{route('imagelist')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-images"></i></div>
                Images
            </a>
            {{-- bonusView --}}
            <div class="sb-sidenav-menu-heading">Bonus</div>
            <a class="nav-link" href="{{route('bonusView')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Bonus
            </a>
            <div class="sb-sidenav-menu-heading">Profile</div>
            <a class="nav-link" href="{{route('changePasswordGet')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-wallet"></i></div>
                Change Password
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{Auth::user()->name}}

    </div>
</nav>
@endsection

@section('rightsidenav')
<h1 class="m-3">Admin Dashboard</h1>
<ol class="breadcrumb m-3">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="row m-3">
    <div class="col-4">
        <div class="card w-100" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">All User List</h5>
              <a href="{{route('userlist')}}" class="btn btn-warning  mt-3">User List</a>
            </div>
          </div>
          <div class="card w-100 mt-4" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">All Image List</h5>
              <a href="{{route('imagelist')}}" class="btn btn-warning mt-3">Image List</a>
            </div>
          </div>
          {{-- <div class="card w-100 mt-4" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">All Transaction List</h5>
              <a href="" class="btn btn-warning mt-3">Transaction List</a>
            </div>
        </div> --}}
        {{-- {{route('imagelist')}} --}}
    </div>

</div>

@endsection


@section('downlinks')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="templete/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="templete/js/datatables-simple-demo.js"></script>
@endsection
