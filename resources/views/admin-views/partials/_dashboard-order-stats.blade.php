<div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="{{route('admin.user.list')}}" style="background: green;">
        <div class="card-body">
            <h6 class="card-subtitle" style="color: white!important;">{{translate('users')}}</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                    <span class="card-title h2" style="color: white!important;">{{$data['user']}}</span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-user ml-6" style="font-size: 30px; color: white;"></i>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="{{ route('admin.user.list') }}" style="background: black;">
        <div class="card-body">
            <h6 class="card-subtitle" style="color: white!important;">{{ translate('active user') }}</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                    <span class="card-title h2" style="color: white!important;">{{ $activeUserCount }}</span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-user ml-6" style="font-size: 30px; color: white;"></i>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="{{ route('admin.user.list') }}" style="background: grey;">
        <div class="card-body">
            <h6 class="card-subtitle" style="color: white!important;">{{ translate('today registration') }}</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                    <span class="card-title h2" style="color: white!important;">{{ $registereddateCount }}</span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-user ml-6" style="font-size: 30px; color: white;"></i>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="{{ route('admin.user.list') }}" style="background:maroon;">
        <div class="card-body">
            <h6 class="card-subtitle" style="color: white!important;">{{ translate('today joins') }}</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                    <span class="card-title h2" style="color: white!important;">{{ $joineddateCount }}</span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-user ml-6" style="font-size: 30px; color: white;"></i>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="{{ route('admin.user.list') }}" style="background:teal;">
        <div class="card-body">
            <h6 class="card-subtitle" style="color: white!important;">{{ translate('tamil users') }}</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                    <span class="card-title h2" style="color: white!important;">{{ $tamilUserCount }}</span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-user ml-6" style="font-size: 30px; color: white;"></i>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="{{ route('admin.user.list') }}" style="background:purple;">
        <div class="card-body">
            <h6 class="card-subtitle" style="color: white!important;">{{ translate('kannada users') }}</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                    <span class="card-title h2" style="color: white!important;">{{ $kannadaUserCount }}</span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-user ml-6" style="font-size: 30px; color: white;"></i>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="{{ route('admin.user.list') }}" style="background:orange;">
        <div class="card-body">
            <h6 class="card-subtitle" style="color: white!important;">{{ translate('other users') }}</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                    <span class="card-title h2" style="color: white!important;">{{ $otherUserCount }}</span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-user ml-6" style="font-size: 30px; color: white;"></i>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
    <!-- Card -->
    <div class="card card-hover-shadow h-100" style="background: red;">
        <div class="card-body">
            <h6 class="card-subtitle" style="color: white!important;">{{ translate('unpaid withdrawals') }}</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                    <span class="card-title h2" style="color: white!important;">Rs.{{ $totalUnpaidWithdrawals }}</span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-money ml-6" style="font-size: 30px; color: white;"></i>
                </div>
            </div>
        </div>
    </div>
</div>







