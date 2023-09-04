@extends('layouts.admin.app')

@section('title', translate('user Preview'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
        <!-- Page Header -->
        <div class="pb-3">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class=""> {{translate('user')}} {{translate('details')}}</h1>
                </div>
                <div class="col-sm mb-2 mb-sm-0">
                    <a href="{{url()->previous()}}" class="btn btn-primary float-right">
                        <i class="tio-back-ui"></i> {{translate('back')}}
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-md-6 col-12 mb-3 mb-lg-2">
                <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">ID</th>
                                <td>{{$user['id']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Name</th>
                                <td>{{$user['name']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">mobile</th>
                                <td>{{$user['mobile']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">email</th>
                                <td>{{$user['email']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">password</th>
                                <td>{{$user['password']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Joined Date</th>
                                <td>{{$user['joined_date']}}</td>
                            </tr>
                           
                </table>
            </div>
</div>
                
            </div>
        </div>
    </div>
@endsection

@push('script_2')

@endpush
