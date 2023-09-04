@extends('layouts.admin.app')

@section('title', translate('Update user'))

<style>
    .password-container {
        position: relative;
    }

    .togglePassword {
        position: absolute;
        top: 14px;
        right: 16px;
    }
</style>

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-edit"></i> {{translate('update user')}}</h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form action="{{route('admin.user.update', [$user['id']])}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('mobile number')}}</label>
                            <input type="text" value="{{$user['mobile']}}" name="mobile" class="form-control" required>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('refer_code')}}</label>
                            <input type="text" value="{{$user['refer_code']}}" name="refer_code" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('referred_by')}}</label>
                            <input type="text" value="{{$user['referred_by']}}" name="referred_by" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{ translate('support lead') }}<i class="text-danger asterik">*</i></label>
    <select name="lead_id" class="form-control" required>
        <option value="">{{ translate('Select a staffs') }}</option>
        @foreach($staffs as $key => $value)
                                    <option value="{{ $key }}" {{ $user->lead_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{ translate('support lead') }}<i class="text-danger asterik">*</i></label>
    <select name="support_id" class="form-control" required>
        <option value="">{{ translate('Select a staffs') }}</option>
        @foreach($staffs as $key => $value)
                                    <option value="{{ $key }}" {{ $user->support_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{ translate('select branch') }}<i class="text-danger asterik">*</i></label>
    <select name="branch_id" class="form-control" required>
        <option value="">{{ translate('Select a branch') }}</option>
        @foreach($branches as $key => $value)
                                    <option value="{{ $key }}" {{ $user->branch_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <div class='col-md-5'>
                    <label class="control-label"> Status</label> <i class="text-danger asterik">*</i>
                    <br>
                    <div id="status" class="btn-group">
                        <label class="btn btn-primary" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                            <input type="radio" name="status" value="0" <?= ($user['status'] == 0) ? 'checked' : ''; ?>>Not-verified
                        </label>
                        <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="status" value="1" <?= ($user['status'] == 1) ? 'checked' : ''; ?>> Verified
                        </label>
                        <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="status" value="2" <?= ($user['status'] == 2) ? 'checked' : ''; ?>> Blocked
                        </label>
                    </div>
                </div>
                </div>

                <button type="submit" class="btn btn-primary">{{translate('submit')}}</button>
            <br>
            <hr>
            <br>
            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('account_number')}}</label>
                            <input type="text" value="{{$user['account_num']}}" name="account_num" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('holder name')}}</label>
                            <input type="text" value="{{$user['holder_name']}}" name="holder_name" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('ifsc')}}</label>
                            <input type="text" value="{{$user['ifsc']}}" name="ifsc" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('bank')}}</label>
                            <input type="text" value="{{$user['bank']}}" name="bank" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('branch')}}</label>
                            <input type="text" value="{{$user['branch']}}" name="branch" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('earn')}}</label>
                            <input type="text" value="{{$user['earn']}}" name="earn" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('balance')}}</label>
                            <input type="text" value="{{$user['balance']}}" name="balance" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('basic wallet')}}</label>
                            <input type="text" value="{{$user['basic_wallet']}}" name="basic_wallet" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('Premium Wallet')}}</label>
                            <input type="text" value="{{$user['premium_wallet']}}" name="premium_wallet" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('Total Ads')}}</label>
                            <input type="text" value="{{$user['total_ads']}}" name="total_ads" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('Today Ads')}}</label>
                            <input type="text" value="{{$user['today_ads']}}" name="today_ads" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class='col-md-3'>
                        <label class="control-label">Status</label> <i class="text-danger asterik">*</i>
                        <br>
                        <div id="withdrawal_status" class="btn-group">
                            <label class="btn btn-primary" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                <input type="radio" name="withdrawal_status" value="0" <?= ($user['withdrawal_status'] == 0) ? 'checked' : ''; ?>>Deactive
                            </label>
                            <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input type="radio" name="withdrawal_status" value="1" <?= ($user['withdrawal_status'] == 1) ? 'checked' : ''; ?>> Active
                            </label>
                       
                    </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('Current Refers')}}</label>
                            <input type="text" value="{{$user['current_refers']}}" name="current_refers" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('Target Refers')}}</label>
                            <input type="text" value="{{$user['target_refers']}}" name="target_refers" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{translate('support_lan')}}</label>
                              <select name="support_lan" class="form-control">
                              <option value=''>--select--</option>
                                 <option value='tamil' {{ $user['support_lan'] == 'tamil' ? 'selected' : '' }}>Tamil</option>
                                 <option value='kannada' {{ $user['support_lan'] == 'kannada' ? 'selected' : '' }}>Kannada</option>
                                 <option value='telugu' {{ $user['support_lan'] == 'telugu' ? 'selected' : '' }}>Telugu</option>
                                 <option value='hindi' {{ $user['support_lan'] == 'hindi' ? 'selected' : '' }}>Hindi</option>
                                 <option value='english' {{ $user['support_lan'] == 'english' ? 'selected' : '' }}>English</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('Joined Date')}}</label>
                            <input type="date" value="{{$user['joined_date']}}" name="joined_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('Min Withdrawal')}}</label>
                            <input type="text" value="{{$user['min_withdrawal']}}" name="min_withdrawal" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('Gender')}}</label>
                            <input type="text" value="{{$user['gender']}}" name="gender" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('Device Id')}}</label>
                            <input type="text" value="{{$user['device_id']}}" name="device_id" class="form-control" required>
                        </div>
                    </div>
                </div>
                </form>
        </div>
    </div>
</div>
@endsection

@push('script_2')
<script>
    function readURL(input, viewer_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#' + viewer_id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFileEg1").change(function () {
        readURL(this, 'viewer');
    });
    $("#customFileEg2").change(function () {
        readURL(this, 'viewer2');
    });
    $("#customFileEg3").change(function () {
        readURL(this, 'viewer3');
    });
</script>

<script>
    // Update label with selected file name
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $(this).next('.custom-file-label').html(fileName);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/switchery@0.8.2/switchery.min.js"></script>
<script>
    // Initialize Switchery for each checkbox
    var checkboxes = document.querySelectorAll('.js-switch');
    checkboxes.forEach(function(checkbox) {
        new Switchery(checkbox);
    });
</script>
@endpush
