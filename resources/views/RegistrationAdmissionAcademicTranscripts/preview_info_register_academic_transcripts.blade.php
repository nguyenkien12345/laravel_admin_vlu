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
    <link rel="stylesheet"
        href="{{asset('css/RegistrationAdmissionAcademicTranscripts/preview_info_register_academic_transcripts.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
    <title>ADMIN VAN LANG</title>
</head>

<body>
    {{-- HEADER --}}

    <div class="container container-preview_info_register_academic_transcripts mt-5">
        <div class="row">
            <div class="col-12">
                <p class="title-preview_info_register_academic_transcripts">Phiếu đăng ký xét tuyển năm 2022</p>
                <p class="description-preview_info_register_academic_transcripts">(Dành cho thí sinh xét kết quả học bạ
                    THPT)</p>
            </div>
        </div>

        <x-title-preview icon='images/icon-information.png' content='1. Thông tin thí sinh'
            style="margin: 28px 0px 10px 0px" />
        <x-note-preview icon='images/ProfileCode.png' title='Mã hồ sơ:'
            content='Sẽ phát sinh sau khi hoàn tất việc nộp hồ sơ' style="margin-bottom: 10px" />

        <x-information-preview :value1='$value1=["Họ và tên", "Mai Thị Thanh Thúy"]' />
        <x-information-preview :value1='$value1=["Giới tính", "Nữ"]' :value2='$value2=["Ngày sinh", "09/01/2000"]' />
        <x-information-preview :value1='$value1=["Điện thoại di động", "0987654321"]'
            :value2='$value2=["Email", "maithithanhthuy@gmail.com"]' />
        <x-information-preview :value1='$value1=["Điện thoại phụ huynh", "0123456789"]' />
        <x-information-preview :value1='$value1=["Số CMND/CCCD", "123456789012"]'
            :value2='$value2=["Quốc tịch", "704|Việt Nam"]' />
        <x-information-preview :value1='$value1=["Dân tộc", "Kinh"]' :value2='$value2=["Tôn giáo", "Không"]' />
        <x-information-preview
            :value1='$value1=["Nơi sinh", "Trung Nghĩa Nghĩa Thành, Châu Đức, Thành phố Bà Rịa Vũng Tàu"]' />
        <x-information-preview
            :value1='$value1=["Địa chỉ liên hệ", "Trung Nghĩa Nghĩa Thành, Châu Đức, Thành phố Bà Rịa Vũng Tàu"]' />
        <x-information-preview :value1='$value1=["Trường THPT thuộc tỉnh/TP", "Thành phố Bà Rịa Vũng Tàu"]'
            :value2='$value2=["Tên trường", "Trường THPT Bà Rịa Vũng Tàu"]' />
        <x-information-preview :value1='$value1=["Năm tốt nghiệp THPT", "2022"]'
            :value2='$value2=["Loại hình tốt nghiệp", "THPT"]' />
        <x-information-preview :value1='$value1=["Học lực lớp 12", "Khá"]'
            :value2='$value2=["Hạnh kiểm lớp 12", "Tốt"]' />
        <x-information-preview :value1='$value1=["Khu vực", "2"]' :value2='$value2=["Đối tượng ưu tiên", "0"]' />

        <x-title-preview icon='images/admission_info.png' content='2. Thông tin xét tuyển'
            style="margin: 28px 0px 10px 0px" />
        <x-note-preview icon='images/RecruitmentPlan.png' title='Phương án tuyển sinh:' content='02'
            style="margin-bottom: 10px" />
    </div>

    {{-- FOOTER --}}
</body>

</html>
