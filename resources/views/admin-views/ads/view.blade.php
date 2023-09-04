@extends('layouts.admin.app')

@section('title', translate('ads Preview'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
        <!-- Page Header -->
        <div class="pb-3">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class=""> {{translate('ads')}} {{translate('details')}}</h1>
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
                            <tr>
                                <th style="width: 200px">Name</th>
                                <td>{{$ads['name']}}</td>
                            </tr>
                                <th style="width: 200px">Image</th>
                                <td>
                                <img style="height: 100px;width:100px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer"
                                        onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                                        src="{{asset('storage/app/public/ads').'/'.$ads['image']}}" alt="ads image"/>
                                </td>
                            </tr>
                </table>
                
            </div>
        </div>
    </div>
@endsection

@push('script_2')

@endpush
