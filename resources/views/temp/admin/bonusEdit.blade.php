@extends('temp.master')

@section('uplinks')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{asset('templete/css/styles.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.all.min.js
    "></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.min.css
    " rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script src="{{asset('js/bonusedit.js')}}"></script>

@endsection

@section('sidenav')
<style>
    .datatable-top,.datatable-bottom{
        display: none;
    }
    .input-hide{
        pointer-events: none;
        background-color: lightgray;
    }
    #coins-error{
        color :red;
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
<h1 class="m-3">Bouns List</h1>
<ol class="breadcrumb mb-4 p-3">
    <li class="breadcrumb-item"><a href="{{ route('user') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Bonus List</li>
</ol>
{{-- Sweet Alert --}}
@include('sweetalert::alert')

<div class="row m-3 p-3 shadow-lg">
    {{-- @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif --}}

    {{-- <div class="alert alert-success" style="display:none">
        {{ Session::get('success') }}
</div> --}}


    <form id="myForm" data-action="{{route('bonusUpdate',$bonusEdit->id)}}"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group my-4">
            <label for="name">Bouns Name</label>
            <input type="text" class="form-control input-hide" id="bonus_name" name="bonus_name" value="{{$bonusEdit->bonus_name}}" >
            <span class="text-danger" id="bonus_name_error"></span>
        </div>

        <div class="form-group my-4">
            <label for="coins">Coins</label>
            <input type="text" class="form-control" id="coins" name="coins" value="{{$bonusEdit->coins}}" >
            <span class="text-danger" id="coins_error"></span>
        </div>

        <button type="submit" class="btn btn-primary" id="submit">Update</button>
    </form>
</div>
@endsection




@section('downlinks')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('templete/js/scripts.js')}}"></script>
    {{-- <script src="{{asset('js/bonusedit.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('templete/js/datatables-simple-demo.js')}}"></script>
@endsection
