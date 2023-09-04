@extends('layouts.admin.app')

@section('title', translate('transaction List'))

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
                        <h1 class=""><i class="tio-filter-list"></i> {{translate('transaction')}} {{translate('List')}}</h1>
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
                            <h5 class="card-header-title">{{translate('transaction Table')}}</h5>
                            <h5 class="card-header-title text-primary mx-1">({{ $transactions->total() }})</h5>
                        </div>
                        <div>
                            <form action="{{url()->current()}}" method="GET">
                                <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search"
                                           class="form-control"
                                           placeholder="{{translate('Search')}}" aria-label="Search"
                                           value="{{$search}}" required autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text"><i class="tio-search"></i>
                                        </button>
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
                                <th>{{translate('ID')}}</th>
                                <th>{{translate('name')}}</th>
                                <th>{{translate('mobile')}}</th>
                                <th>{{translate('type')}}</th>
                                <th>{{translate('datetime')}}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($transactions as $key => $transaction)
                                <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ optional($transaction->user)->name }}</td>
                                    <td>{{ optional($transaction->user)->mobile }}</td>
                                    <td>{{ $transaction->type }}</td>
                                    <td>{{ $transaction->datetime }}</td>
                                    </td>
                               
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
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        $('#search-form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.transaction.search')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('.page-area').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $('.table').DataTable({
                "paging": false
            });

            $('#status').on('change', function () {
                datatable
                    .columns(0)
                    .search(this.value)
                    .draw();
            });

            $('#date').on('change', function () {
                datatable
                    .columns(5)
                    .search(this.value)
                    .draw();
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $(this).select2();
            });
        });
    </script>
@endpush
