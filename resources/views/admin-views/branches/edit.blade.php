@extends('layouts.admin.app')

@section('title', translate('Update branches'))
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
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{translate('update branches')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.branches.update',[$branches['id']])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('name')}}</label>
                                <input type="text" value="{{$branches['name']}}" name="name"
                                       class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('mobile')}}</label>
                                <input type="text" value="{{$branches['mobile']}}" name="mobile"
                                       class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('short_code')}}</label>
                                <input type="text" value="{{$branches['short_code']}}" name="short_code"
                                       class="form-control" required>
                            </div>
                            <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{translate('support_lan')}}</label>
                              <select name="support_lan" class="form-control">
                              <option value=''>--select--</option>
                                 <option value='tamil' {{ $branches['support_lan'] == 'tamil' ? 'selected' : '' }}>Tamil</option>
                                 <option value='kannada' {{ $branches['support_lan'] == 'kannada' ? 'selected' : '' }}>Kannada</option>
                                 <option value='telugu' {{ $branches['support_lan'] == 'telugu' ? 'selected' : '' }}>Telugu</option>
                                 <option value='hindi' {{ $branches['support_lan'] == 'hindi' ? 'selected' : '' }}>Hindi</option>
                                 <option value='english' {{ $branches['support_lan'] == 'english' ? 'selected' : '' }}>English</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{translate('submit')}}</button>
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
        // Update label with selected file name
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        });
   </script>
@endpush
