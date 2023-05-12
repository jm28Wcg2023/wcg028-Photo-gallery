@extends('temp.master')

@section('uplinks')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('templete/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.all.min.js
    "></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.min.css
    " rel="stylesheet">

    <style>
        label.error {
         color: #dc3545;
         font-size: 14px;
    }
    .img{
        padding: 0.25rem;
        background-color: #fff;
        border: 1px solid var(--bs-border-color);
        border-radius: 0.375rem;
    }
    </style>
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
    <h2 class="m-3">Edit Images Details</h2>
    <ol class="breadcrumb m-3">
        <li class="breadcrumb-item"><a href="{{ route('user') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Edit Images Details</li>
    </ol>
    <div class="container px-5 my-5 shadow-lg py-5">
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <h4 class="mb-4">Change Details</h4>

        <form action="{{route('UserUpdateImage',$imageData->id)}}" id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group my-4">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$imageData->name}}" >
                <span class="text-danger" id="name_error"></span>
            </div>

            <div class="form-group my-4">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" >{{$imageData->description}}</textarea>
                <span class="text-danger" id="description_error"></span>
            </div>

            <div class="form-group my-4">
                <label for="coin">Coin</label>
                <input type="number" class="form-control" id="coin" name="coin" value="{{$imageData->coin}}" >
                <span class="text-danger" id="coin_error"></span>
            </div>

            <div class="form-group my-4">
                <label for="coin">Image</label>
                <img src="{{ asset('images/' . $imageData->image_path) }}" width="150" class="img" width="300px">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection


@section('downlinks')
    <script>
        $(document).ready(function() {
            function isValidate(){
                $("#editForm").validate({
                    rules: {
                        name: {
                            required :true,
                            // noSpace: true,
                        },
                        description: {
                            required :true,
                            // noSpace: true,
                        },
                        coin:{
                            required :true,
                            number: true,

                            // noSpace: true,
                        },

                    },
                    messages: {
                        name: {
                            required: "Please enter a name.",
                        },
                        description: {
                            required: "Please enter a description.",
                        },
                        coin: {
                            required: "Please select a coin.",
                            number: "Please enter a valid number",
                        },
                    }
                });
            }

            $('form').submit(function(e) {
                e.preventDefault();

                // if(isValidate()){ // client side validation start

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:"{{route('UserUpdateImage',$imageData->id)}}",
                        method:"POST",
                        data:new FormData(this),
                        type:'json',
                        contentType: false,
                        cache : false,
                        processData: false,
                        success:function(data)
                        {
                            Swal.fire({
                                icon: 'success',
                                title: 'Good job!',
                                text: 'Image Data Updated Successfully!',
                                timer: 4000
                            })
                            // console.log(data)
                            // window.location = '{{ route('userimagelist') }}'
                        },
                        error:function(xhr, status, error){
                            var errors = xhr.responseJSON.errors;
                            console.log(errors)
                            $.each(errors, function (key, value) {
                                $("#" + key + "_error").text(value[0]);
                                $("#" + key).addClass("is-invalid");
                            });

                        }
                    });
                // } // client side validation end
            });
        });
    </script>

    <!-- custom -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="{{ asset('js/scripts_custom.js') }}"></script>

    <!-- default -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/datatables-simple-demo.js')}}"></script>
@endsection
