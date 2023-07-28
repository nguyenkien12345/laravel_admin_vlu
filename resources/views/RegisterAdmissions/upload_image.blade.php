<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap-5.1.3-dist/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/RegisterAdmissions/upload_image.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
    <title>ADMIN VAN LANG</title>
</head>

<body>
    {{-- HEADER --}}

    <div class="container container-upload-images-register-talent mt-5">
        <div class="row upload-images-register-talent-top">
            <div class="col-12">
                <p class="title-preview-info-top">Đăng ký dự thi năng khiến năm 2023</p>
                <p class="description-preview-info-top">
                    ({{config('content.search_profile.description.dang_ky_thi_nang_khieu')}})
                </p>
            </div>
        </div>

        <div class="row upload-images-register-talent-body">
            <div class="col-12">
                <p class="title-preview-info-body">Upload thẻ của bạn</p>
                <div class="info-preview-info-body">
                    <img class="image-preview-info-body" src="{{asset('images/ProfileCode.png')}}" alt="">
                    <p class="description-preview-info-body">
                        Vui lòng đăng tải file hình ảnh hoặc scan ảnh 3x4 tại đây
                    </p>
                </div>
                <form action="" id="form-upload-image-selfie">
                    @csrf
                    <div class="file form-field">
                        <input type="file" name="image_selfie" id="imageSelfie" class="form-input" />
                        <label for="imageSelfie" class="form-label">
                            <img class="fas fa-upload image-selfie-icon" src="{{asset('images/UploadImage.png')}}" />
                            <span class="image-selfie-text">Kéo thả hình hoặc click vào đây để upload ảnh 3x4 của
                                bạn</span>
                        </label>
                    </div>
                    <div class="progress-upload-image-selfie">
                        <div class="bar-upload-image-selfie"></div>
                        <div class="percent--upload-image-selfie"></div>
                    </div>
                    <div class="btns-upload-image-selfie">
                        <button class="btn-back" id="btnBack">Quay lại</button>
                        <button class="btn-back" id="btnPreviewProfile">Xem trước hồ sơ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
</body>

<script>

</script>

</html>
