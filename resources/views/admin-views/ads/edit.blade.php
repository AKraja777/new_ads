@extends('layouts.admin.app')

@section('title', translate('Update ads'))

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
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{translate('update ads')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.ads.update', [$ads['id']])}}" method="post" enctype="multipart/form-data">
                    @csrf
                   

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('image')}}</label><small style="color: red">* ( {{translate('ratio')}} 1:1 )</small>
                            <div class="custom-file">
                                <input type="file" name="image" id="customFileEg2" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                <label class="custom-file-label" for="customFileEg2">{{translate('choose')}} {{translate('file')}}</label>
                            </div>
                            <center>
                                <img style="height: 200px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer2" onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'" src="{{asset('storage/app/public/ads').'/'.$ads['image']}}" alt="image"/>
                            </center>
                        </div>
                    </div>

                
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
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@endpush
