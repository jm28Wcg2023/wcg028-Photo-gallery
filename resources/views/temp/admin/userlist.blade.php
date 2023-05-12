@extends('temp.master')

@section('uplinks')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('templete/css/styles.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
@endsection

@section('sidenav')
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{route('admin')}}">
                {{-- {{route('dash')}} --}}
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link" href="{{route('market')}}">
                {{-- {{route('dash')}} --}}
                <div class="sb-nav-link-icon"><i class="fa-solid fa-shop"></i></div>
                Market
            </a>
            <div class="sb-sidenav-menu-heading">Tables</div>
            <a class="nav-link" href="{{route('userlist')}}">
                {{-- {{route('dash')}} --}}
                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Users
            </a>
            <a class="nav-link" href="{{route('imagelist')}}">
                {{-- {{route('dash')}} --}}
                <div class="sb-nav-link-icon"><i class="fa-solid fa-images"></i></div>
                Images
            </a>
            <div class="sb-sidenav-menu-heading">Bonus</div>
            <a class="nav-link" href="{{route('bonusView')}}">
                {{-- {{route('dash')}} --}}
                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Bonus
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
    <h1 class="m-3">User List</h1>
    <ol class="breadcrumb mb-4 p-3">
        <li class="breadcrumb-item"><a href="{{ route('user') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">User List</li>
    </ol>
    @include('sweetalert::alert')
    <div class="row m-3">
        <div class="col d-flex justify-content-end">
            <!-- Button trigger modal -->
            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalToggleLabel">Add User</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="myForm"  action="{{route('addUser')}}" method="POST" enctype="multipart/form-data">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputName1" class="form-label">Name</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name"  name="name" aria-describedby="NameHelp" value="{{ old('name') }}">
                                <span class="text-danger error-text" id=" name_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email"  aria-describedby="emailHelp" value="{{ old('email') }}">
                                <span class="text-danger error-text email_err" id=" email_err"></span>

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"  name="phone" aria-describedby="PhoneHelp" value="{{ old('phone') }}">
                                <span class="text-danger error-text phone_err" id=" phone_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" >
                                <span class="text-danger error-text password_err" id=" password_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn-submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

        </div>
    </div>

    <div class="row m-3 p-3 shadow-lg">
        <table class="table table-info caption-top" id="datatablesSimple">
            <thead>
                <tr>
                    {{-- <th>User ID</th> --}}
                    <th>User Name</th>
                    <th>No of Images</th>
                    <th>No of images Purchased</th>
                    <th>Wallet Amount</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        {{-- <td>{{$user['id']}}</td> --}}
                        <td>{{$user['name']}}</td>
                        <td>{{$user['image_count']}}</td>
                        <td>{{$user['user_image_count']}}</td>
                        <td>{{$user['wallet']['wallet_coin']}}</td>
                        <td>
                            {{-- {{route('UserEditImage',$sample->id)}} --}}
                            <a class="btn" href="{{route('editUserView',$user['id'])}}" role="button"><i class="bi bi-pencil-square" style="color:rgb(245, 173, 49);"></i></a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('deleteUser',$user['id']) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn delete" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle-fill" style="color:red;"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection


@section('downlinks')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/scripts.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/datatables-simple-demo.js')}}"></script>
@endsection
