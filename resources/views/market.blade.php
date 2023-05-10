@extends('layouts.app')

@section('content')
{{-- <div class="container-fluid"> --}}
    <div class="container">
        {{-- <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form> --}}
    </div>
    <style>
        .py-4 {
        padding-top: 0rem !important;
        padding-bottom: 0rem !important;
        }
        /* body{
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000 100%), url("../assets/img/bg-masthead.jpg");
        } */
        img{
            width: 414px;
            height:276px;
        }
        .card-body{
            width:414px;
            height: 185.33px;
        }
        .download{
            display: hidden;
        }
        body{
            background-color: #212529!important;
        }
    </style>
    <section class="bg-dark p-4">
        <div class="container" id="resultsContainer">
            <!--
                Image       Width 414 Height 276
                Card Body   Width 414 Height 185.33
                serach image can be using alt="Here add the img Name/Description" in img tag
            -->
            <header class="masthead-new p-5">
                <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            <h1 class="mx-auto my-0 text-uppercase">Photo Gallery</h1>
                            <h2 class="text-white-50 mx-auto mt-2 mb-5">Excellence in photography</h2>
                        </div>
                    </div>
                </div>
            </header>
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
            {{--sweet alert--}}
            @include('sweetalert::alert')
            <div class="row">
                <div class="col-md-12">
                  <form>
                    <div class="row d-flex justify-contnet-between">
                        <div class="col ">
                            <div class="form-group">
                              <input type="text" class="form-control" id="search" data-action="{{ route("cards") }}" placeholder="Search by name or description">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                              <select class="form-control" data-action="{{ route("cards") }}" id="sort">
                                <option value="name_asc" >Sort by name: A-Z</option>
                                <option value="name_desc" >Sort by name: Z-A</option>
                                <option value="coin_asc" >Sort by coin: Low to high</option>
                                <option value="coin_desc">Sort by coin: High to low</option>
                              </select>
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row" id="card-list">
                {{-- Cards will be dynamically loaded here --}}
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


            {{-- route variables pass to the js file --}}
            <script type="text/javascript">
                var PostUri = "{{ route('cards') }}";
                var auth = '{{ Auth::check() }}';
                var download = '{{ route("download.image", "") }}';
                var purchase = '{{ route("purchase.image", "") }}';
                var plzLogin = '{{ route("plzLogin") }}';
                var Role ='{{ Auth::user()->role}}';
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
            <script src="{{ asset('js/market.js') }}"></script>
@endsection
