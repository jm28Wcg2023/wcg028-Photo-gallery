@extends('layouts.app')

@section('content')
<style>
    #DataTables_Table_0_filter{
        float: right;
    }
</style>
<div class="container" >
    <div class="row mt-4">
        <div class="col-3">
            <div class="card">
                <div class="card-header fs-4 text-bg-dark">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('User Name :') }} {{Auth::user()->name}}<br>
                    <hr>
                    {{ __('User Email :') }} {{Auth::user()->email}}<br>
                    <hr>
                    {{ __('User Phone :') }} {{Auth::user()->phone}}<br>
                    <hr>
                    {{ __('User Id :') }} {{Auth::user()->id}}<br>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header bg-primary text-white fw-bolder fs-5">{{ __('User Referal Card') }}</div>

                <div class="card-body">
                    {{ __('Referal Code :') }} {{Auth::user()->affiliation_link}}
                      <div class="row">
                        <div class="col">
                            {{-- value="{{ url('/register?ref=' . Auth::user()->affiliation_link) }}" --}}
                            <input type="text" class="form-control w-100" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="{{ url('/register?ref=' . Auth::user()->affiliation_link) }}" id="myInput">
                        </div>
                        <div class="col">
                            <button  onclick="myFunction()" class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                        </div>
                      </div>
                </div>
            </div>
            {{-- Not Use --}}
            <div class="card" style="display: none;">
                <div class="card-header">{{ __('User Wallet') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('User Name :') }} {{Auth::user()->name}}
                </div>
            </div>
        </div>
    </div>
    {{-- User Card Info --}}
    <div class="row mt-4 " style="display: none;">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white fw-bolder fs-5">{{ __('User Referal Card') }}</div>

                <div class="card-body">
                    {{ __('Referal Code :') }} {{Auth::user()->affiliation_link}}
                      <div class="row">
                        <div class="col">
                            <input type="text" class="form-control w-100" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="{{ url('/register?ref=' . Auth::user()->affiliation_link) }}" id="myInput">
                        </div>
                        <div class="col">
                            <button  onclick="myFunction()" class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-5">
            <div class="row">
                <h4 class="p-3"> User Images List </h4>
            </div>
            <div class="row">
                {{-- id=tblSample --}}
                <table class=" tblSample table caption-top">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Image Name</th>
                            <th>Image Description</th>
                            <th>Image Coin</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Demo1</td>
                            <td>12</td>
                            <td>1</td>
                            <td>50</td>
                            <td>
                                {{-- <form method="post" action="{{url('student/'.$item->id)}}">
                                    @csrf
                                    @method('DELETE') --}}
                                    <button class="btn" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle-fill" style="color:red;"></i></button>
                                {{-- </form>  --}}
                            </td>
                        </tr>
                        <tr>
                            <td>Demo4</td>
                            <td>2</td>
                            <td>1</td>
                            <td>50</td>
                            <td>
                                {{-- <form method="post" action="{{url('student/'.$item->id)}}">
                                    @csrf
                                    @method('DELETE') --}}
                                    <button class="btn" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle-fill" style="color:red;"></i></button>
                                {{-- </form>  --}}
                            </td>
                        </tr>
                        <tr>
                            <td>Demo2</td>
                            <td>12</td>
                            <td>3</td>
                            <td>20</td>
                            <td>
                                {{-- <form method="post" action="{{url('student/'.$item->id)}}">
                                    @csrf
                                    @method('DELETE') --}}
                                    <button class="btn" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle-fill" style="color:red;"></i></button>
                                {{-- </form>  --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-header">{{ __('Add Image') }}</div>
                {{-- @if (count($errors) > 0)
                    <ul><li>{{ $error }}</li></ul>
                @endif --}}
                <div class="card-body">
                    <form method="post" action="{{route('upload')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Image Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="image_name" class="form-control" />
                            </div>
                            <small class="text-danger"> @error('image_name') {{ $message }} @enderror </small>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Image Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="image_description" class="form-control" />
                                <small class="text-danger"> @error('image_description') {{ $message }} @enderror </small>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-label-form">Image Coin</label>
                            <div class="col-sm-10">
                                <input type="text" name="image_coin" class="form-control" />
                                <small class="text-danger"> @error('image_coin') {{ $message }} @enderror </small>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-label-form">Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="images[]" multiple="multiple" />
                                <small class="text-danger"> @error('images') {{ $message }} @enderror </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <input type="submit" class="btn btn-primary w-50" value="Upload" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
