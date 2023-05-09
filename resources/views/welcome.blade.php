@extends('layouts.app')
@section('content')
{{-- <div class="row mt-5">
    <div class="d-flex justify-content-center">
        <h1>Photo Gallery</h1>
    </div>
</div> --}}

<!-- Masthead-->
<style>
    .py-4 {
    padding-top: 0rem !important;
    padding-bottom: 0rem !important;
    }
</style>
<header class="masthead">
    @include('sweetalert::alert')
    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">Welcome To Photo Gallery</h1>
                <h2 class="text-white-50 mx-auto mt-2 mb-5">Excellence in photography</h2>
                <a class="btn btn-primary" href="{{route('login')}}">Get Started</a>
            </div>
        </div>
    </div>
</header>
@endsection
{{-- End welcome File --}}
