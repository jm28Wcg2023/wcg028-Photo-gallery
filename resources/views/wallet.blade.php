@extends('layouts.app')
@section('content')
<style>
    #DataTables_Table_0_filter{
        float: right;
    }
</style>
{{-- <h1>Wallet {{Auth::user()->name}}</h1> --}}
<div class="container">
    <div class="card">
        <div class="card-header fs-4 text-bg-dark">{{ __('Wallet') }}</div>

        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    {{ __('User Name :') }} {{Auth::user()->name}}<br>
                    <hr>
                    {{ __('User Email :') }} {{Auth::user()->email}}<br>
                    <hr>
                    {{ __('User Phone :') }} {{Auth::user()->phone}}<br>
                </div>
                <div class="col-4">
                    <div class="card h-100">
                        <div class="card-header fs-5 text-bg-info">{{ __('Available Wallet Coin') }}</div>
                        <div class="card-body">
                             <h5>{{__('550')}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion mt-3" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button fs-4 text-bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                Wallet Transction History
            </button>
          </h2>
          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
                <div class="row">
                    <table class=" tblSample table caption-top">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>wallet Transction type</th>
                                <th>Transaction Amount</th>
                                <th>Transaction Description</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Demo1</td>
                                <td><span class="badge rounded-pill bg-danger">Debit</span></td>
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
                                <td><span class="badge rounded-pill bg-success">Credit</span></td>
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
                                <td><span class="badge rounded-pill bg-danger">Debit</span></td>
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
          </div>
        </div>
      </div>
    <div class="card mt-3" style="display: none">
        <div class="card-header fs-4 text-bg-dark">{{ __('Wallet Transction History') }}</div>

        <div class="card-body">
            <div class="row">
                <table class=" tblSample table caption-top">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>wallet Transction type</th>
                            <th>Transaction Amount</th>
                            <th>Transaction Description</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Demo1</td>
                            <td><span class="badge rounded-pill bg-danger">Debit</span></td>
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
                            <td><span class="badge rounded-pill bg-success">Credit</span></td>
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
                            <td><span class="badge rounded-pill bg-danger">Debit</span></td>
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
    </div>

</div>

@endsection
