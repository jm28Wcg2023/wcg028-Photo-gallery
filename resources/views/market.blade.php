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
                            {{-- <input class="form-control me-2" type="text" id="myFilter" onkeyup="buttonUp()" name="search" placeholder="Search Images Here.."> --}}
                            {{-- <form action="{{ route('search') }}" class="d-flex justify-content-between" method="GET">
                                <input class="form-control " type="text" id="myFilter" name="search" placeholder="Search Images Here.." required>
                                <button type="submit" class="btn btn-secondary">Search</button>
                            </form> --}}
                            {{-- <div class="row mt-3"> --}}
                                {{-- <div class="col d-flex justify-content-start">
                                    <input class="form-control me-2 w-50" id="myOwner" onkeyup="buttonUpOwner()" type="text" name="search" placeholder="Search Owner Name..">
                                </div> --}}
                                {{-- <button type="button" class="btn btn-primary btn-lg mr-3" id="btnSort">Sort</button>
                                <button type="button" class="btn btn-primary btn-lg mr-3" id="btnSortA">ASort</button> --}}


                                {{-- <select id="sort-select">
                                    <option value="name">Name</option>
                                    <option value="owner">Owner</option>
                                    <option value="coin">Coin</option>
                                </select> --}}


                                {{-- <div class="col d-flex justify-content-end">
                                    <select class="form-select w-50"  name="dropdown" aria-label="Default select example">
                                        <option selected>Filter ..</option>
                                        <option value="ASC">Image Name A -> Z Order</option>
                                        <option value="DEC">Image Name Z -> A Order</option>
                                      </select> --}}
                                      {{-- <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle bg-warning text-dark" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                            Filter ..
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                          <li><button class="dropdown-item" type="button">select ..</button></li>
                                          <li><button class="dropdown-item" type="button">Image Name A -> Z Order</button></li>
                                          <li><button class="dropdown-item" type="button">Image Name Z -> A Order</button></li>
                                        </ul>
                                      </div> --}}
                                {{-- </div> --}}
                            {{-- </div> --}}
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

            {{-- {!! $images->links() !!} --}}

            {{-- <div class="cardSort">
                <div class="row" id="myItems">
                    @foreach ($images as $image)
                        <div class="col-md-6 col-lg-4">
                            <div class="card my-3 card-block">
                                <img src="{{ asset('images/' . $image->image_path) }}" class="card-img-top" alt="{{ $image->name }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col d-flex justify-content-between">
                                            <p class="card-title fs-5">{{ $image->name }}</p>
                                            <p class="badge rounded-pill bg-success fs-6 ownername"><i class="bi bi-person"></i> {{ $image->user->name }}</p>
                                        </div>
                                    </div>
                                    <p class="card-text">{{ $image->description }}</p>
                                    <p class="card-text badge rounded-pill bg-success fs-6">{{ $image->coin }} <i class="bi bi-cash text-warning fs-6"></i></p>
                                    <div class="d-flex justify-content-between">
                                        @if (Auth::check())
                                            @if (Auth::user()->role == 0)
                                                @if (in_array($image->id,$image_own_id))
                                                    <a href="{{ route('download.image',$image->id) }}"  class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>
                                                @else
                                                    @if (!in_array($image->id,$imageId))
                                                        <a href="{{ route('purchase.image',$image->id) }}" id="buy" data-id="{{$image->id}}" class="btn btn-warning">Buy</a>
                                                    @endif

                                                    @if (in_array($image->id,$imageId))
                                                        <a href="{{ route('download.image',$image->id) }}"  class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>
                                                    @endif
                                                @endif
                                            @else
                                            <form method="post" action="{{route('ImageDeleteAdmin',$image->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle-fill" style="color:red;"></i></button>
                                                </form>

                                                <a href="{{ route('download.image',$image->id) }}"  class="btn btn-dark d-flex w-0 justify-content-start download" id="download"><i class="bi bi-arrow-down"></i></a>
                                            @endif
                                        @else
                                            <a href="{{ route('plzLogin') }}" id="buy" class="btn btn-warning">Buy</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-end">
                        {!! $images->links() !!}
                    </div>
                </div>
            </div> --}}

            {{-- <div class="cardSort">
                <div class="row" id="myItems">
                    @foreach ($images as $image)
                        <div class="col-md-6 col-lg-4">
                            <div class="card my-3 card-block">
                                <img src="{{ asset('images/' . $image->image_path) }}" class="card-img-top" alt="{{ $image->name }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col d-flex justify-content-between">
                                            <p class="card-title fs-5">{{ $image->name }}</p>
                                            <p class="badge rounded-pill bg-success fs-6 ownername"><i class="bi bi-person"></i> {{ $image->user->name }}</p>
                                        </div>
                                    </div>
                                    <p class="card-text">{{ $image->description }}</p>
                                    <p class="card-text badge rounded-pill bg-success fs-6">{{ $image->coin }} <i class="bi bi-cash text-warning fs-6"></i></p>
                                    <div class="d-flex justify-content-between">
                                        @if (Auth::check())
                                            @if (Auth::user()->role == 0)
                                                @if (in_array($image->id,$image_own_id))
                                                    <a href="{{ route('download.image',$image->id) }}"  class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>
                                                @else
                                                    @if (!in_array($image->id,$imageId))
                                                        <a href="{{ route('purchase.image',$image->id) }}" id="buy" data-id="{{$image->id}}" class="btn btn-warning">Buy</a>
                                                    @endif

                                                    @if (in_array($image->id,$imageId))
                                                        <a href="{{ route('download.image',$image->id) }}"  class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>
                                                    @endif
                                                @endif
                                            @else
                                            <form method="post" action="{{route('ImageDeleteAdmin',$image->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle-fill" style="color:red;"></i></button>
                                                </form>

                                                <a href="{{ route('download.image',$image->id) }}"  class="btn btn-dark d-flex w-0 justify-content-start download" id="download"><i class="bi bi-arrow-down"></i></a>
                                            @endif
                                        @else
                                            <a href="{{ route('plzLogin') }}" id="buy" class="btn btn-warning">Buy</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> --}}
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
                              <select class="form-control" id="sort">
                                <option value="name_asc" data-action="{{ route("cards") }}">Sort by name: A-Z</option>
                                <option value="name_desc" data-action="{{ route("cards") }}">Sort by name: Z-A</option>
                                <option value="coin_asc" data-action="{{ route("cards") }}">Sort by coin: Low to high</option>
                                <option value="coin_desc" data-action="{{ route("cards") }}">Sort by coin: High to low</option>
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

{{-- <script>
   $(document).on("click", "#buy" , function() {
    var button_id = $(this).data('data-id');
    // var el = this;
    $.ajax({
        url: '{{ route('purchase.image',$image->id) }}',
        type: 'get',
        success: function(response){
        $('#buy').remove();

        }
    });
    });
</script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
      loadCards();

      // Search functionality
      $('#search').on('keyup', function() {
        var query = $(this).val();
        $.ajax({
          url: 'cards',
          type: 'GET',
          dataType: 'json',
          data: {
            search: query,
            // sort: $('#sort').val()
          },
          success: function(data) {
            displayCards(data);
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      });

      // Sort functionality
      $('#sort').on('change', function() {
        var query = $('#search').val();
        $.ajax({
          url: 'cards',
          type: 'GET',
          dataType: 'json',
          data: {
            query: query,
            sort:$('#sort').val()
          },
          success: function(data) {
            displayCards(data);
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      });

      function loadCards() {
        $.ajax({
          url: 'cards',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            displayCards(data);
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      }

      function displayCards(data) {
        var cards = '';
        console.log(data)
        $.each(data, function(index, value) {
            cards += '<div class="col-md-6 col-lg-4">';
            cards += '<div class="card my-3 card-block">';
            cards += '<img src="{{ asset('images/') }}/'+ value.image_path +'" class="card-img-top" alt="'+ value.name +'">';
            cards += '<div class="card-body">';
            cards += '<div class="row">';
            cards += '<div class="col d-flex justify-content-between">';
            cards += '<p class="card-title fs-5">'+ value.name +'</p>';
            cards += '<p class="badge rounded-pill bg-success fs-6 ownername"><i class="bi bi-person"></i> '+ value.user.name +'</p>';
            cards += '</div>';
            cards += '</div>';
            cards += '<p class="card-text">'+ value.description +'</p>';
            cards += '<p class="card-text badge rounded-pill bg-success fs-6">'+ value.coin +' <i class="bi bi-cash text-warning fs-6"></i></p>';
            cards += '<div class="d-flex justify-content-between">';
            // if(checkLogin){
            cards += '@if (Auth::check())';
                if (value.is_owned || value.user_id == "{{ Auth::user()->id }}") {
                    cards += '<a href="{{ route("download.image", "") }}/' + value.id + '" class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>';
                } else if (value.is_purchased) {
                    cards += '<a href="{{ route("download.image", "") }}/' + value.id + '" class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>';
                } else {
                    cards += '<a href="{{ route("purchase.image", "") }}/' +value.id+'" id="buy" data-id="'+ value.id +'" class="btn btn-warning">Buy</a>';
                }
            cards += '@else';
            // }else {
                cards += '<a href="{{ route("plzLogin") }}" class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>';
            cards += '@endif';


            cards += '</div>';
            cards += '</div>';
            cards += '</div>';
            cards += '</div>';
        });

        $('#card-list').html(cards);
        }
    });
        </script>
         {{-- <script type="text/javascript">
            var PostUri = "{{ route('cards') }}";
       </script>
<script src="{{ asset('js/market.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
@endsection
