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
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <style>
        .error{
            color: red;
        }
    </style>
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
    <h1 class="m-3">Add Images</h1>
    <ol class="breadcrumb m-3">
        <li class="breadcrumb-item"><a href="{{ route('user') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Add Image</li>
    </ol>

<div class="container px-5 my-5 shadow-lg py-5 d-none ">
<form action="{{ route('addmorePost') }}" method="POST" id="image-upload-form" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        <table class="table table-bordered" id="dynamicTable">
            <tr>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>
                    <input type="text" name="addmore[0][name]" placeholder="Enter Image Name" id="addmore_0_name" class="form-control checkName" />
                    <span class="text-dan"></span>
                    <span class="text-danger" id="addmore_0_name_error"></span>
                </td>
                <td>
                    <input type="text" name="addmore[0][description]" placeholder="Enter Image Description" id="addmore_0_description" class="form-control checkDescription" />
                    <span class="text-dan"></span>
                    <span class="text-danger" id="addmore_0_description_error"></span>
                </td>
                <td>
                    <input type="text" name="addmore[0][coin]" placeholder="Enter your Coin" id="addmore_0_coin" class="form-control checkPrice" />
                    <span class="text-dan"></span>
                    <span class="text-danger" id="addmore_0_coin_error"></span>
                </td>
                <td>
                    <input type='file' name="addmore[0][image]" id="addmore_0_image" class='form-control checkImage'  accept='image/*' >
                    <span class="text-dan"></span>
                    <span class="text-danger" id="addmore_0_image_error"></span>
                </td>
                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>

            </tr>
        </table>

        <button type="submit" class="btn btn-success">Upload</button>
    </form>
</div>

<div class="container px-5 my-5 shadow-lg py-5">

    <h2 class="mb-5">Upload Images</h2>
    {{-- @if ($errors->any())
        @php
            dd($errors);
        @endphp
    @endif --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('images.upload') }}" data-route="{{ route('images.upload') }}" id="myForm" enctype="multipart/form-data" >
        @csrf

        <div class="form-group">
            <label for="images">Choose Images</label>
            <input type="file" class="form-control-file @error('images') is-invalid @enderror" name="images[]" id="images"  accept=".jpg, .jpeg, .png" multiple >
            <br>
            <span class="text-danger" id="images_error"></span>
            @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <table class="table m-3">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Coins</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody id="image-table">
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary mt-3 " id="onsubmit">Upload</button>
    </form>


</div>
<script>
//     $(document).ready(function() {

//         var count = 0;
//         $('input[type=file]').change(function(e) {
//             $('#image-table').html('');
//             var files = e.target.files;

//             for (var i = 0; i < files.length; i++) {
//                 var file = files[i];
//                 var filename = file.name;
//                 var reader = new FileReader();
//                 reader.onload = function(e) {
//                     var html = `
//                         <tr id="row-${count}" data-rowid="">
//                             <td>
//                                 <img src="${e.target.result}" width="100">
//                             </td>
//                             <td>
//                                 <div class="form-group">
//                                     <label for="title-${count}">Title:</label>
//                                     <input type="text" class="form-control checkName  @error('titles.*') is-invalid @enderror" name="titles[]" id="title-${count}" >
//                                     <span class="text-danger" id="titles_${count}_error"></span>
//                                     {{--@error('titles.*')
//                                         <div class="invalid-feedback">{{ $message }}</div>
//                                     @enderror--}}
//                                     {{--@error('titles.${count}')
//                                         <div class="alert alert-danger">{{ $message }}</div>
//                                     @enderror--}}
//                                     {{--<div class="invalid-feedback error-title-${count}"></div>--}}
//                                 </div>
//                             </td>
//                             <td>
//                                 <div class="form-group">
//                                     <label for="description-${count}">Description:</label>
//                                     <input type="text" class="form-control checkDescription  @error('descriptions.*') is-invalid @enderror" name="descriptions[]" id="description-${count}" >
//                                     <span class="text-danger" id="descriptions_${count}_error"></span>

//                                     {{--@error('descriptions.*')
//                                         <div class="invalid-feedback">{{ $message }}</div>
//                                     @enderror--}}
//                                     {{--@error('descriptions.${count}')
//                                         <div class="alert alert-danger">{{ $message }}</div>
//                                     @enderror--}}
//                                     {{--<div class="invalid-feedback error-description-${count}"></div>--}}
//                                 </div>
//                             </td>
//                             <td>
//                                 <div class="form-group">
//                                     <label for="coin-${count}">Coin:</label>
//                                     <input type="number" class="form-control checkCoin  @error('coins.*') is-invalid @enderror" name="coins[]" id="coin-${count}" >
//                                     <span class="text-danger" id="coins_${count}_error"></span>
//                                     {{--@error('coins.*')
//                                         <div class="invalid-feedback">{{ $message }}</div>
//                                     @enderror--}}
//                                     {{-- @error('coins.${count}')
//                                         <div class="alert alert-danger">{{ $message }}</div>
//                                     @enderror--}}
//                                     {{--<div class="invalid-feedback error-coin-${count}"></div>--}}
//                                 </div>
//                             </td>
//                         </tr>
//                     `;
//                     $('#image-table').append(html);
//                     count++;
//                 };
//                 reader.readAsDataURL(file);
//             }

//         });

//         // $('#myForm').submit(function(e) {
//         $('#myForm').on('submit', function (e) {
//             e.preventDefault();
//             var formData = new FormData(this);

//             $.ajax({
//                 url: "{{ route('images.upload') }}",
//                 type:"POST",
//                 data: formData,
//                 dataType: 'json',
//                 cache: false,
//                 contentType: false,
//                 processData: false,
//                 success: function(response) {
//                     // handle success
//                     $('#myForm')[0].reset();
//                     $('#image-table').html('');

//                 },
//                 error: function(xhr, status, error) {
//                     var errors = xhr.responseJSON.errors;
//                     $.each(errors, function (key, value) {
//                         var id = key.replace(/\./g, "_");
//                         var newvar = key.replace(/\./g, "-");
//                         $("#" + id + "_error").text(value[0]);
//                         $("#" + newvar).addClass("is-invalid");
//                     });
//                 }
//             });
//         });
// });

// function displayErrors(errors) {
//     // iterate through the errors object and display the messages
//     for (var key in errors) {
//         if (errors.hasOwnProperty(key)) {
//             var messages = errors[key];
//             for (var i = 0; i < messages.length; i++) {
//             var message = messages[i];
//             var parts = message.split('.');
//             var index = parts[1];

//             // update error message for dynamic field
//             $('.error-' + parts[0] + '-' + index).text(message);
//             }
//         }
//         }
//     }


</script>



    <!-- custom -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="{{ asset('js/scripts_custom.js') }}"></script>
    <script src="{{ asset('js/addimage.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>


    <!-- default -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/datatables-simple-demo.js')}}"></script>
@endsection

