@extends('layouts.admin.app')

@section('title', translate('Dashboard'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .grid-card {
            border: 2px solid #00000012;
            border-radius: 10px;
            padding: 10px;
        }

        .label_1 {
            position: absolute;
            font-size: 10px;
            background: #FF4C29;
            color: #ffffff;
            width: 80px;
            padding: 2px;
            font-weight: bold;
            border-radius: 6px;
            text-align: center;
        }

        .center-div {
            text-align: center;
            border-radius: 6px;
            padding: 6px;
            /*border: 2px solid #8080805e;*/
        }
    </style>
@endpush

@section('content')
    @if(Helpers::module_permission_check(MANAGEMENT_SECTION['dashboard_management']))
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header"
                 style="padding-bottom: 0!important;border-bottom: 0!important;margin-bottom: 1.25rem!important;">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">{{translate('welcome')}}, {{auth('admin')->user()->f_name}}.</h1>
                        <p>{{translate('welcome_message')}}</p>
                    </div>
                    <div class="col-sm mb-2 mb-sm-0" style="height: 25px">
                        <label class="badge badge-soft-success float-right">
                            Software Version : {{ env('SOFTWARE_VERSION') }}
                        </label>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Card -->
            <div class="card card-body mb-3 mb-lg-5">
                <!-- <div class="row gx-2 gx-lg-3 mb-2">
                    <div class="col-9">
                        <h4><i style="font-size: 30px"
                               class="tio-chart-bar-4"></i>{{translate('dashboard_order_statistics')}}</h4>
                    </div>
                    <div class="col-3">
                        <select class="custom-select" name="statistics_type" onchange="order_stats_update(this.value)">
                            <option value="overall" {{session()->has('statistics_type') && session('statistics_type') == 'overall'?'selected':''}}>
                                {{translate('Overall Statistics')}}
                            </option>
                            <option value="today" {{session()->has('statistics_type') && session('statistics_type') == 'today'?'selected':''}}>
                                {{\App\CentralLogics\translate("Today's Statistics")}}
                            </option>
                            <option value="this_month" {{session()->has('statistics_type') && session('statistics_type') == 'this_month'?'selected':''}}>
                                {{\App\CentralLogics\translate("This Month's Statistics")}}
                            </option>
                        </select>
                    </div>
                </div> -->
                <div class="row gx-2 gx-lg-3" id="order_stats">
                    @include('admin-views.partials._dashboard-order-stats',['data'=>$data])
                </div>
            </div>
            <!-- End Card -->

        </div>
    @endif
 @endsection

        @push('script')
            <script src="{{asset('public/assets/admin')}}/vendor/chart.js/dist/Chart.min.js"></script>
            <script src="{{asset('public/assets/admin')}}/vendor/chart.js.extensions/chartjs-extensions.js"></script>
            <script src="{{asset('public/assets/admin')}}/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js"></script>
        @endpush
