@extends('layouts.app')

@section('content')
<style>
    .py-4 {
    padding-top: 0rem !important;
    padding-bottom: 0rem !important;
    }

    #DataTables_Table_0_filter{
        float: right;
    }
</style>
<div class="container" style="background-color: #fff9f9">
    <div style="display:none;">
        <div class="row">
            <h3 class="p-3"> User List </h3>
        </div>
        {{-- user list --}}
        <div class="row">
            <table id="tblSample" class=" tblSample table caption-top">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>phone</th>
                    <th>Role</th>
                    <th>Referral code</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->role}}</td>
                    <td>{{$item->affiliation_link}}</td>
                    <td>
                        {{-- <form method="post" action="{{url('student/'.$item->id)}}">
                            @csrf
                            @method('DELETE') --}}
                            <button class="btn  " onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle-fill" style="color:red;"></i></button>
                            {{-- </form>  --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <h3 class="p-3"> Final User List </h3>
    </div>
    <div class="row">
        {{-- id=tblSample --}}
        <table class=" tblSample table caption-top">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>No of Images</th>
                    <th>No of images Purchased</th>
                    <th>Wallet Amount</th>
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

    <div class="row">
        <h3 class="p-3"> Image List </h3>
    </div>
    <div class="row">
        {{-- id=tblSample --}}
        <table class=" tblSample table caption-top">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image Name</th>
                    <th>Image Description</th>
                    <th>User ID/Name</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Demo1</td>
                    <td>Private Limited</td>
                    <td>jm </td>
                    <td>
                        {{-- <form method="post" action="{{url('student/'.$item->id)}}">
                            @csrf
                            @method('DELETE') --}}
                            <button class="btn  " onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle-fill" style="color:red;"></i></button>
                        {{-- </form>  --}}
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Demo2</td>
                    <td>sample Limited</td>
                    <td>jeet </td>
                    <td>
                        {{-- <form method="post" action="{{url('student/'.$item->id)}}">
                            @csrf
                            @method('DELETE') --}}
                            <button class="btn  " onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle-fill" style="color:red;"></i></button>
                        {{-- </form>  --}}
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Demo3</td>
                    <td>sample</td>
                    <td>Rohit </td>
                    <td>
                        {{-- <form method="post" action="{{url('student/'.$item->id)}}">
                            @csrf
                            @method('DELETE') --}}
                            <button class="btn  " onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle-fill" style="color:red;"></i></button>
                        {{-- </form>  --}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as Admin!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
