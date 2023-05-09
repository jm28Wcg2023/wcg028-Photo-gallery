@extends('temp.master')

@section('uplinks')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{asset('templete/css/styles.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@endsection

@section('sidenav')
<style>
    .datatable-top,.datatable-bottom{
        display: none;
    }
</style>
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
<h1 class="m-3">Bouns List</h1>
<ol class="breadcrumb mb-4 p-3">
    <li class="breadcrumb-item"><a href="{{ route('user') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Bonus List</li>
</ol>
<div class="row m-3 p-3 shadow-lg">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @include('sweetalert::alert')
    <table class="table caption-top" id="datatablesSimple">
        <thead>
            <tr>
                <th>Bouns Name</th>
                <th>Bouns Coins</th>
                <th>Change</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bonus_list as $bonus)
            <tr>
                <td>{{$bonus->bonus_name}}</td>
                <td>{{$bonus->coins}}</td>
                <td>
                    <a class="btn" href="{{route('bonusEdit',$bonus->id)}}" role="button"><i class="bi bi-pencil-square" style="color:rgb(245, 173, 49);"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection


@section('downlinks')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('templete/js/scripts.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('templete/js/datatables-simple-demo.js')}}"></script>
@endsection
