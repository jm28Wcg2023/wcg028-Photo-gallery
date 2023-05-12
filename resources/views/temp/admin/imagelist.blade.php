@extends('temp.master')

@section('uplinks')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('templete/css/styles.css')}}" rel="stylesheet" />
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
    <h1 class="p-3">Image List</h1>
    <ol class="breadcrumb mb-4 p-3">
        <li class="breadcrumb-item"><a href="{{ route('user') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Image List</li>
    </ol>
    <div class="row m-3 p-3 shadow-lg">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <table class="table caption-top" id="datatablesSimple">
            <thead>
                <tr>
                    {{-- <th>Id</th> --}}
                    <th>Image</th>
                    <th>Image Name</th>
                    <th>Image Description</th>
                    <th>Coins</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($images as $image)
                <tr>
                    {{-- <td>{{$image->id}}</td> --}}
                    <td ><img src="{{ asset('images/' . $image->image_path) }}" height="60" class="w-25" alt="{{ $image->name }}"></td>
                    <td>{{$image->name}}</td>
                    <td>{{$image->description}}</td>
                    <td>{{$image->coin}}</td>
                    <td>
                        <form method="post" action="{{route('ImageDeleteAdmin',$image->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle-fill" style="color:red;"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection


@section('downlinks')
    {{-- custom --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="{{ asset('js/scripts_custom.js')}}"></script>
    {{-- Old --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/scripts.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/datatables-simple-demo.js')}}"></script>
@endsection
