@extends('layouts.admin.app')

@section('title', translate('app_activation'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="container">
        <div class="row pt-5 mt-10">
            <div class="col-md-12">
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                <div class="mar-ver pad-btm text-center">
                    <h1 class="h3">Please Enter your App {{$app_name}} Purchase Code</h1>
                </div>
                <div class="text-muted font-13">
                    <form method="POST" action="{{route('admin.app-activate',[$app_id])}}">
                        @csrf

                        <div class="form-group">
                            <label for="purchase_code">Purchase Code</label>
                            <input type="text" class="form-control" id="purchase_key"
                                   name="purchase_key" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn">
                                <i class="tio-key"></i>
                                Activate
                            </button>
                        </div>
                    </form>

                    <div class="mar-ver pad-btm text-center mt-5">
                        <p>
                            <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code"
                               class="text-info">Where to get purchase code?</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')

@endpush
