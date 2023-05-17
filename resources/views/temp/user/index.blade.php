<div class="container">
    <h2 class="mb-4">Uploaded Images</h2>

    <div class="row">
        @foreach ($images as $image)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/' . $image->image_path) }}" class="card-img-top" alt="{{ $image->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $image->name }}</h5>
                        <p class="card-text">{{ $image->description }}</p>
                        <p class="card-text">{{ $image->coin }} coins</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
