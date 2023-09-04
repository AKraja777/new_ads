@extends('layouts.admin.app')

@section('title', translate('withdrawal List'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="pb-3">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0 row">
                    <div class="col-12 col-sm-6">
                        <h1 class=""><i class="tio-filter-list"></i> {{translate('withdrawal')}} {{translate('List')}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header flex-between">
                        <div class="flex-start">
                            <h5 class="card-header-title">{{translate('withdrawal Table')}}</h5>
                            <h5 class="card-header-title text-primary mx-1">({{ $withdrawals->total() }})</h5>
                            <div class="col-md-3">
                                <button class="btn btn-success mark-as-status" data-status="1">{{ translate('Paid') }}</button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-danger mark-as-status" data-status="2">{{ translate('Cancelled') }}</button>
                            </div>
                        </div>
                        <div>
                            <form action="{{url()->current()}}" method="GET">
                                <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search"
                                           class="form-control"
                                           placeholder="{{translate('Search')}}" aria-label="Search"
                                           value="{{$search}}" required autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text"><i class="tio-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{ translate('Select') }}</th>
                                <th>{{translate('ID')}}</th>
                                <th>{{translate('Mobile')}}</th>
                                <th>{{translate('Status')}}</th>
                                <th>{{translate('amount')}}</th>
                                <th>{{translate('datetime')}}</th>
                                <th>{{translate('earn')}}</th>
                                <th>{{translate('Account Number')}}</th>
                                <th>{{translate('Holder Name')}}</th>
                                <th>{{translate('Bank')}}</th>
                                <th>{{translate('branch')}}</th>
                                <th>{{translate('ifsc')}}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($withdrawals as $key => $withdrawal)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="withdrawal-checkbox" value="{{ $withdrawal->id }}">
                                    </td>
                                    <td>{{ $withdrawal->id }}</td>
                                    <td>{{ optional($withdrawal->user)->mobile }}</td>
                                    <td>
                                        @if($withdrawal['status'] == 0)
                                            <div style="margin-top:12px;">
                                                <p class="text text-primary">{{translate('unpaid')}}</p>
                                            </div>
                                        @elseif($withdrawal['status'] == 1)
                                            <div style="margin-top:12px;">
                                                <p class="text text-success">{{translate('paid')}}</p>
                                            </div>
                                        @elseif($withdrawal['status'] == 2)
                                            <div style="margin-top:12px;">
                                                <p class="text text-danger">{{translate('cancelled')}}</p>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $withdrawal->amount }}</td>
                                    <td>{{ $withdrawal->datetime }}</td>
                                    <td>{{ optional($withdrawal->user)->earn }}</td>
                                    <td>{{ optional($withdrawal->user)->account_num }}</td>
                                    <td>{{ optional($withdrawal->user)->holder_name }}</td>
                                    <td>{{ optional($withdrawal->user)->bank }}</td>
                                    <td>{{ optional($withdrawal->user)->branch }}</td>
                                    <td>{{ optional($withdrawal->user)->ifsc }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    {{ $withdrawals->links() }}
                </div>
            </div>
        </div>
    </div>
    @push('script_2')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const markAsPaidButton = document.querySelector('.mark-as-status[data-status="1"]');
        const markAsCancelledButton = document.querySelector('.mark-as-status[data-status="2"]');

        markAsPaidButton.addEventListener('click', function () {
            updateWithdrawalStatus(1); // Status code for Paid
        });

        markAsCancelledButton.addEventListener('click', function () {
            updateWithdrawalStatus(2); // Status code for Cancelled
        });

        function updateWithdrawalStatus(status) {
            const selectedWithdrawalIds = [];
            const selectedCheckboxes = document.querySelectorAll('.withdrawal-checkbox:checked');

            selectedCheckboxes.forEach(function (checkbox) {
                selectedWithdrawalIds.push(checkbox.value);
            });

            if (selectedWithdrawalIds.length > 0) {
                fetch('{{ route('admin.update.withdrawal.status') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: status,
                        withdrawal_ids: selectedWithdrawalIds
                    })
                }).then(function (response) {
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        console.error('Failed to update withdrawal statuses.');
                    }
                }).catch(function (error) {
                    console.error('An error occurred:', error);
                });
            } else {
                console.error('No withdrawal selected.');
            }
        }
    });
</script>
@endpush
@endsection
