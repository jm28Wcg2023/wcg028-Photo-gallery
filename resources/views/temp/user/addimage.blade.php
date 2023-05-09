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

<!-- <div class="container px-5 my-5 shadow-lg py-5 ">

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="alert alert-success print-success-msg" style="display:none">
        <ul></ul>
    </div>
    @include('sweetalert::alert')

    <h3 class="jumbotron mb-4">Image Upload </h3>
    <form name="myForm" id="myForm" method="post" action="{{url('AjaxImageUpload')}}" enctype="multipart/form-data">
        @csrf
        <div class="input-group control-group img_div form-group col-md-4" >
            <div class="input-group-btn">
                <button class="btn btn-success btn-add-more" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-4" id="btnAdd" style="margin-top:10px">Upload Image</button>
    </form>
</div> -->

<!-- <script type="text/javascript">
    $(document).ready(function() {
        var count = 0;
        function mySelect(){
            var html = "<div class='clone hide'>\
                            <div class='control-group input-group form-group col-md-4' style='margin-top:10px'>\
                                <table>\
                                    <tr>\
                                        <td>\
                                            <input type='text' name='name["+count+"]' placeholder='Image Name' class='form-control checkName' />\
                                            <span class='text-danger error-text name_err'></span>\
                                        </td>\
                                        <td>\
                                            <input type='text' name='description["+count+"]' placeholder='Image Description' class='form-control checkDescription' />\
                                            <span class='text-danger error-text description_err'></span>\
                                        </td>\
                                        <td>\
                                            <input type='text' name='coin["+count+"]' placeholder='Image Price' class='form-control checkPrice' />\
                                            <span class='text-danger error-text coin_err'></span>\
                                        </td>\
                                        <td>\
                                            <input type='file'  id='profileImage' name='profileImage["+count+"]' class='form-control checkImage' accept='image/*' >\
                                            <span class='text-danger error-text profileImage_err'></span>\
                                        </td>\
                                    </tr>\
                                </table>\
                                <div class='input-group-btn'><button class='btn btn-danger btn-remove' type='button'><i class='glyphicon glyphicon-remove'></i> X</button></div>\
                            </div>\
                        </div>";
          $(".img_div").after(html);
          count++;
        }
        $(".btn-add-more").click(function(){
            mySelect()
        });

        window.onload = (event) => {
            mySelect()
            mySelect()
        };
        $("body").on("click",".btn-remove",function(){
            $(this).parents(".control-group").remove();
        });
        $("#myForm").validate();

        $("body").on("click",".btn-remove",function(){
            $(this).parents(".control-group").remove();
        });

        $('form').submit(function(e) {
            e.preventDefault();
            let firstName = $('#name[0]');


            $('.checkName').each(function (e) {
                $(firstName).rules("add", {
                    required: true
                });
            });
            $('.checkDescription').each(function (e) {
                $(this).rules("add", {
                    required: true
                });
            });
            $('.checkPrice').each(function (e) {
                $(this).rules("add", {
                    required: true,
                    number:true,
                });
            });
            $('.checkImage').each(function (e) {
                $(this).rules("add", {
                    required: true,
                });
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{route('AjaxImageUpload')}}",
                method:"POST",
                data:new FormData(this),
                type:'json',
                contentType: false,
                cache : false,
                processData: false,
                success:function(data)
                {
                    Swal.fire(
                        'Good job!',
                        'Image Uploaded Successfully!',
                        'success'
                        )
                    // window.location = '{{ route('userimagelist') }}'
                    document.getElementById("myForm").reset();
                }
           });
        });
    });
</script> -->



<div class="container px-5 my-5 shadow-lg py-5 ">
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

<script type="text/javascript">

    var i = 0;

    $("#add").click(function(){

        ++i;

        $("#dynamicTable").append('<tr>\
            <td>\
                <input type="text" name="addmore['+i+'][name]" id="addmore_'+i+'_name" placeholder="Enter Image Name checkName" class="form-control checkName" />\
                <span class="text-dan"></span>\
                <span class="text-danger" id="addmore_'+i+'_name_error"></span>\
            </td>\
            <td>\
                <input type="text" name="addmore['+i+'][description]" id="addmore_'+i+'_description" placeholder="Enter Image Description" class="form-control checkDescription" />\
                <span class="text-dan"></span>\
                <span class="text-danger" id="addmore_'+i+'_description_error"></span>\
            </td>\
            <td>\
                <input type="text" name="addmore['+i+'][coin]" id="addmore_'+i+'_coin" placeholder="Enter your Coin" class="form-control checkPrice" />\
                <span class="text-dan"></span>\
                <span class="text-danger" id="addmore_'+i+'_coin_error"></span>\
            </td>\
            <td>\
                <input type="file" name="addmore['+i+'][image]" id="addmore_'+i+'_image" class="form-control checkImage" accept="image/*" >\
                <span class="text-dan"></span>\
                <span class="text-danger" id="addmore_'+i+'_image_error"></span>\
            </td>\
            <td>\
                <button type="button" class="btn btn-danger remove-tr">Remove</button>\
            </td>\
            </tr>');
    });

    $(document).on('click', '.remove-tr', function(){
         $(this).parents('tr').remove();
    });

    $(document).ready(function () {


        function validateFormFields() {
            var name = true;
            var description = true;
            var coin = true;
            var image = true;

            $('.checkName').each(function() {
                    if ($(this).val().trim() == '') {
                        name = false;
                        $(this).addClass('border-danger');
                        $(this).siblings('.text-danger').text('Please enter a valid name without spaces');
                    } else {
                        $(this).removeClass('border-danger');
                        $(this).siblings('.text-danger').text('');
                    }
            });

            $('.checkDescription').each(function() {
                    if ($(this).val().trim() == '') {
                        description = false;
                        $(this).addClass('border-danger');
                        $(this).siblings('.text-danger').text('Please enter a valid description without spaces');
                    } else {
                        $(this).removeClass('border-danger');
                        $(this).siblings('.text-danger').text('');
                    }
            });

            $('.checkPrice').each(function() {
                    if ($(this).val().trim() == '') {
                        coin = false;
                        $(this).addClass('border-danger');
                        $(this).siblings('.text-danger').text('Please enter a valid coin amount');
                    } else if (!$.isNumeric($(this).val().trim())) {
                        coin = false;
                        $(this).addClass('border-danger');
                        $(this).siblings('.text-danger').text('Please enter a valid coin amount (numeric only)');
                    } else {
                        $(this).removeClass('border-danger');
                        $(this).siblings('.text-danger').text('');
                    }
            });

            $('.checkImage').each(function() {
                var file = $(this).val();
                if (file != '') {
                    var ext = file.split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
                        image = false;
                        $(this).addClass('border-danger');
                        $(this).siblings('.text-danger').text('Please upload an image file in JPG, JPEG, or PNG format only');
                    } else {
                        $(this).removeClass('border-danger');
                        $(this).siblings('.text-danger').text('');
                    }
                } else {
                    image = false;
                    $(this).addClass('border-danger');
                    $(this).siblings('.text-danger').text('Please select an image file');
                }
            });

            return name && description && coin && image;
        }

        $('#image-upload-form').on('submit', function (e) {

            e.preventDefault();

            if (validateFormFields()) {

                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ route("addmorePost") }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        Swal.fire({
                                icon: 'success',
                                title: 'Good job!',
                                text: 'Image Uploaded Successfully!',
                                timer: 4000
                            })

                        $('#image-upload-form')[0].reset();
                    },
                    error: function (xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            var id = key.replace(/\./g, "_");
                            $("#" + id + "_error").text(value[0]);
                            $("#" + id).addClass("is-invalid");
                        });

                    }
                });
            }

        });
    });



</script>

@endsection


@section('downlinks')
    <!-- custom -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="{{ asset('js/scripts_custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>


    <!-- default -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templete/js/datatables-simple-demo.js')}}"></script>
@endsection
