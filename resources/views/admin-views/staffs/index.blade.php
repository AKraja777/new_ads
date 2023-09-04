@extends('layouts.admin.app')

@section('title', translate('Add new staffs'))
<style>
    .password-container{
        position: relative;
    }

    .togglePassword{
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
        <div class="pb-3">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class=""><i class="tio-add-circle-outlined"></i> {{translate('add')}} {{translate('new')}} {{translate('staffs')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.staffs.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('name')}}<i class="text-danger asterik">*</i></label>
                                <input type="text" name="name" class="form-control" placeholder="{{translate(' Name')}}"
                                    required>
                            </div>
                         </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label class="input-label" for="exampleFormControlInput1">{{translate('email')}}<i class="text-danger asterik">*</i></label>
                              <input type="text" name="email" class="form-control" placeholder="{{translate('email')}}"
                                 required>
                             </div> 
                         </div> 
                     </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('mobile number')}}<i class="text-danger asterik">*</i></label>
                                <input type="text" name="mobile" class="form-control" placeholder="{{translate(' mobile')}}"
                                    required>
                            </div>
                         </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label class="input-label" for="exampleFormControlInput1">{{translate('password')}}<i class="text-danger asterik">*</i></label>
                              <input type="text" name="password" class="form-control" placeholder="{{translate('password')}}"
                                 required>
                             </div> 
                         </div> 
                        <div class="col-md-3">
                           <div class="form-group">
                             <label class="input-label" for="exampleFormControlInput1">{{translate('salary')}}<i class="text-danger asterik">*</i></label>
                             <input type="text" name="salary" class="form-control" placeholder="{{translate('salary')}}"
                                required>
                            </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                             <label class="input-label" for="exampleFormControlInput1">{{translate('date of birth')}}<i class="text-danger asterik">*</i></label>
                             <input type="date" name="dob" class="form-control" placeholder="{{translate('date of birth')}}"
                                required>
                            </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('bank_name')}}<i class="text-danger asterik">*</i></label>
                                <input type="text" name="bank_name" class="form-control" placeholder="{{translate(' bank_name')}}"
                                    required>
                            </div>
                         </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label class="input-label" for="exampleFormControlInput1">{{translate('branch')}}<i class="text-danger asterik">*</i></label>
                              <input type="text" name="branch" class="form-control" placeholder="{{translate('branch')}}"
                                 required>
                             </div> 
                         </div> 
                        <div class="col-md-3">
                           <div class="form-group">
                             <label class="input-label" for="exampleFormControlInput1">{{translate('account number')}}<i class="text-danger asterik">*</i></label>
                             <input type="text" name="bank_account_number" class="form-control" placeholder="{{translate('account number')}}"
                                required>
                            </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                             <label class="input-label" for="exampleFormControlInput1">{{translate('ifsc_code')}}<i class="text-danger asterik">*</i></label>
                             <input type="text" name="ifsc_code" class="form-control" placeholder="{{translate('ifsc_code')}}"
                                required>
                            </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{ translate('branch_id') }}<i class="text-danger asterik">*</i></label>
    <select name="branch_id" class="form-control" required>
        <option value="">{{ translate('Select a branch') }}</option>
        @foreach($branches as $branch)
            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
        @endforeach
    </select>
                            </div>
                         </div>
                     </div>
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('balance')}}<i class="text-danger asterik">*</i></label>
                                <input type="text" name="balance" class="form-control" placeholder="{{translate(' balance')}}"
                                    required>
                            </div>
                         </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label class="input-label" for="exampleFormControlInput1">{{translate('earn')}}<i class="text-danger asterik">*</i></label>
                              <input type="text" name="earn" class="form-control" placeholder="{{translate('earn')}}"
                                 required>
                             </div> 
                         </div> 
                        <div class="col-md-3">
                           <div class="form-group">
                             <label class="input-label" for="exampleFormControlInput1">{{translate('incentives')}}<i class="text-danger asterik">*</i></label>
                             <input type="text" name="incentives" class="form-control" placeholder="{{translate('incentives')}}"
                                required>
                            </div>
                        </div>
                     </div>
                </div>
                    <button type="submit" class="btn btn-primary">{{translate('submit')}}</button>
                    <input type="reset" onClick="refreshPage()" class="btn-warning btn" value="Clear" />
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
                    $('#'+viewer_id).attr('src', e.target.result);
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
         $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
        }); 
    </script>
    <script>
        // Update label with selected file name
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        });
   </script>
@endpush
