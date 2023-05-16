{{-- @foreach ($posts as $post)
<div class="card mb-2">
    <div class="card-body">{{ $post->id }}
        <h5 class="card-title">{{ $post->title }}</h5>
        {!! $post->body !!}
    </div>
</div>
@endforeach --}}
<div class="row" id="myItems">
{{-- @php
    dd($images);
@endphp --}}
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
