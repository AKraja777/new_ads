@extends('layouts.admin.app')

@section('title', translate('Add new branches'))
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
                    <h1 class=""><i class="tio-add-circle-outlined"></i> {{translate('add')}} {{translate('new')}} {{translate('branches')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.branches.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('name')}}<i class="text-danger asterik">*</i></label>
                                <input type="text" name="name" class="form-control" placeholder="{{translate(' Name')}}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('mobile')}}<i class="text-danger asterik">*</i></label>
                                <input type="text" name="mobile" class="form-control" placeholder="{{translate('mobile')}}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('short_code')}}<i class="text-danger asterik">*</i></label>
                                <input type="text" name="short_code" class="form-control" placeholder="{{translate('short_code')}}"
                                       required>
                            </div>
                            <div class="form-group">
                                 <label class="input-label" for="exampleFormControlInput1">{{translate('support_lan')}}<i class="text-danger asterik">*</i></label>
                                   <select name="support_lan" class="form-control">
                                    <option value=''>--select--</option>
                                    <option value='tamil'>Tamil</option>
                                    <option value='kannada'>Kannada</option>
                                    <option value='telugu'>Telugu</option>
                                    <option value='hindi'>Hindi</option>
                                     <option value='english'>English</option>
                              </select>
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
