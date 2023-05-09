@extends('temp.master')

@section('uplinks')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('templete/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

@endsection
@section('sidenav')
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{route('user')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link" href="{{route('market')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Market
            </a>
            <div class="sb-sidenav-menu-heading">Insert Data</div>
            <a class="nav-link" href="{{route('addimage')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-images"></i></div>
                Add Images
            </a>
            <div class="sb-sidenav-menu-heading">Tables</div>
            <a class="nav-link" href="{{route('userimagelist')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-images"></i></div>
                Images
            </a>
            <a class="nav-link" href="{{route('wallet')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-wallet"></i></div>
                Wallet
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
<h1 class="m-3">Images List</h1>
<ol class="breadcrumb m-3">
    <li class="breadcrumb-item"><a href="{{ route('user') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Image List</li>
</ol>
<div class="row m-3">
    <div class="col d-flex justify-content-end">
        <!-- Extra Large modal -->
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#extraLargeModal">User Purchased Images</button>

        <div id="extraLargeModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content mt-5">
                    <div class="modal-header">
                        <h5 class="modal-title">User Purchased Images</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                              <tr class="table-dark">
                                <th>Id</th>
                                <th>Image Id</th>
                                <th>Image</th>
                                <th>Image Name</th>
                                <th>Image Description</th>
                                <th>Image Coin</th>
                                <th>Download</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchasedImageData as $key => $image)
                                    @foreach ($image->user_image as $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{$user->id}}</td>
                                        {{-- --}}
                                        <td>
                                            <img src="{{ asset('images/' . $user->image_path) }}" height="60" class="card-img-top w-50" alt="{{ $user->name }}">
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->description}}</td>
                                        <td>{{$user->coin}}</td>
                                        <td>
                                            <a href="{{ route('download.image',$user->id) }}" class="btn d-flex justify-content-center"><i class="fa-solid fa-download"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row m-3 p-3 shadow-lg">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <table class=" tblSample table caption-top" id="datatablesSimple">
        <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Image Name</th>
                <th>Image Description</th>
                <th>Image Coin</th>
                <th>Edit</th>
                <th>Download</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($userOwnImageList as $sample)
            <tr>
                <td>{{$sample->id}}</td>
                <td><img src="{{ asset('images/' . $sample->image_path) }}" height="60" class="card-img-top w-50" alt="{{ $sample->name }}"></td>
                <td>{{$sample->name}}</td>
                <td>{{$sample->description}}</td>
                <td>{{$sample->coin}}</td>
                <td>
                    <a class="btn" id="editImage" href="{{route('UserEditImage',$sample->id)}}" role="button"><i class="bi bi-pencil-square" style="color:rgb(245, 173, 49);"></i></a>
                </td>
                <td>
                    <a href="{{ route('sample.image',$sample->id) }}" class="btn d-flex justify-content-center"><i class="fa-solid fa-download"></i></a>
                </td>
                <td>
                    <form method="post" action="{{route('ImageDeleteUser',$sample->id)}}">
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

    <!-- custom -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="{{ asset('js/scripts_custom.js') }}"></script>

    <!-- default -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/datatables-simple-demo.js')}}"></script>
@endsection
