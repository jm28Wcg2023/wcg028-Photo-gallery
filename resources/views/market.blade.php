@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/market.css') }}" rel="stylesheet">
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
                                <input type="text" class="form-control" id="searchInput" data-action="{{ route("market") }}" placeholder="Search by name or description">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                <select class="form-control" data-action="{{ route("market") }}" id="sortSelect">
                                    <option value="lazyname_asc" >Sort by name: A-Z</option>
                                    <option value="lazyname_desc" >Sort by name: Z-A</option>
                                    <option value="price_asc" >Sort by coin: Low to high</option>
                                    <option value="price_desc">Sort by coin: High to low</option>
                                </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="data-wrapper">
                @include('image-card-data')
            </div>

            <!-- Data Loader -->
            <div class="auto-load text-center" style="display: none;">
                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                    <path fill="#000"
                        d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                            from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                    </path>
                </svg>
            </div>


            <div class="container">
                <h3 class="text-center mb-5 mt-5"></h3>
                    <div class="row" id="data_temp">
                </div>
                <div class="ajax-load text-center text-white" style="display:none">
                    <i class="mdi mdi-48px mdi-spin mdi-loading"></i> Loading ...
                </div>
                <div class="no-data text-center mb-4" style="display:none">
                    <b>No data - last page</b>
                </div>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript">
                var route = '{{ route("market") }}';
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
            <script src="{{ asset('js/market.js') }}"></script>

@endsection
