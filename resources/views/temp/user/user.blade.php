@extends('temp.master')

@section('uplinks')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="templete/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .referred_link{
            pointer-events: none;
            background-color: lightgray;
        }
    </style>
@endsection
@section('sidenav')
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{route('user')}}">
                {{-- {{route('dash')}} --}}
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link" href="{{route('market')}}">
                {{-- {{route('dash')}} --}}
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Market
            </a>
            <div class="sb-sidenav-menu-heading">Insert Data</div>
            <a class="nav-link" href="{{route('addimage')}}">
                {{-- {{route('dash')}} --}}
                <div class="sb-nav-link-icon"><i class="fa-solid fa-images"></i></div>
                Add Images
            </a>
            <div class="sb-sidenav-menu-heading">Tables</div>
            <a class="nav-link" href="{{route('userimagelist')}}">
                {{-- {{route('dash')}} --}}
                <div class="sb-nav-link-icon"><i class="fa-solid fa-images"></i></div>
                Images
            </a>
            <a class="nav-link" href="{{route('wallet')}}">
                {{-- {{route('dash')}} --}}
                <div class="sb-nav-link-icon"><i class="fa-solid fa-wallet"></i></div>
                Wallet
            </a>
            <div class="sb-sidenav-menu-heading">Profile</div>
            <a class="nav-link" href="{{route('changePasswordGet')}}">
                {{-- {{route('changePassword')}} --}}
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
<h1 class="m-3">User Dashboard</h1>
<ol class="breadcrumb m-3">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="row m-3">
    <div class="col-5">
        <div class="card">
            <div class="card-header fs-5 fw-bolder text-bg-dark">{{ __('User Profile') }}</div>

            <div class="card-body">
                {{ __('User Name :') }} {{Auth::user()->name}}<br>
                <hr>
                {{ __('User Email :') }} {{Auth::user()->email}}<br>
                <hr>
                {{ __('User Phone :') }} {{Auth::user()->phone}}<br>
                {{-- <hr> --}}
                {{-- {{ __('User Id :') }} {{Auth::user()->id}}<br> --}}
                <hr>
                <div class="row">
                    <div class="col-4">
                        {{ __('Change Password :') }}
                    </div>
                    <div class="col-8">
                        <a class="btn btn-warning" href="{{ route('changePasswordGet') }}" role="button">{{ __('Change password') }}</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="row">
            <div class="col d-flex justify-content-start mb-3">
                <div class="card w-25">
                    <div class="card-header fs-5 text-bg-success">{{ __('Available Wallet Coin') }}</div>
                    <div class="card-body">
                        @foreach ($availableWalletCoin as $item)
                            <h5>{{$item['wallet_coin']}}</h5>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white fw-bolder fs-5">{{ __('User Referal Card') }}</div>
            <div class="card-body">
                {{ __('Referal Code :') }} {{Auth::user()->affiliation_link}}
                  <div class="row">
                    <div class="col-7">
                        <input type="text" class="form-control w-100 referred_link" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="{{ url('/referral-register?ref=' . Auth::user()->affiliation_link) }}" id="myInput">
                    </div>
                    <div class="col-5">
                        <button  onclick="myFunction()" class="btn btn-outline-secondary text-dark" type="button" id="button-addon2" style="background-color: rgb(255, 180, 180)">Tap To Copy</button>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('downlinks')
    <!-- custom -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="js/scripts_custom.js"></script>
    <!-- default -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../templete/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../templete/js/datatables-simple-demo.js"></script>
@endsection
