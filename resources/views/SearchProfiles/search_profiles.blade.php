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
    <link rel="stylesheet" href="{{asset('css/SearchProfiles/search_profiles.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
    <title>ADMIN VAN LANG</title>
</head>

<body>
    {{-- HEADER --}}

    <div class="container container-search-profiles mt-5">
        <div class="row">
            <form id="form-search-profile" novalidate>
                @csrf
                <div class="col-3">
                    <div class="form-field">
                        <select class="form-select" name="admission_time" id="admissionTime">
                            <option value="" selected>Chọn thời gian/ đợt xét tuyển</option>
                            @foreach ($admissionsTime as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <label class="form-label">Đợt xét tuyển <span style="color: red">*</span></label>
                        <span class="error-message" id="errAdmissionTime">ERROR</span>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-field">
                        <select class="form-select" name="admission_type" id="admissionType">
                            <option value="" selected>Chọn hình thức</option>
                            @foreach ($admissionsType as $item)
                            <option value="{{$item->value_crm}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <label class="form-label">Hình thức xét tuyển <span style="color: red">*</span></label>
                        <span class="error-message" id="errAdmissionType">ERROR</span>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-field">
                        <input type="text" name="phone_nid" id="phoneNid" class="form-input"
                            placeholder="Nhập CMND/CCCD hoặc số điện thoại">
                        <label for="" class="form-label">Số điện thoại/ CMND/ CCCD <span
                                style="color: red">*</span></label>
                        <span class="error-message" id="errPhoneNid">ERROR</span>
                    </div>
                </div>

                <div class="col-2">
                    <button id='btnSearchProfile' type="button">Tìm hồ sơ</button>
                </div>
            </form>
        </div>

        <div class="row search-not-found">
            <div class="col-12">
                <p class="search-not-found-title">Không tìm thấy hồ sơ tương ứng</p>
            </div>
        </div>

        @include('Loader.index')
    </div>

    {{-- FOOTER --}}
</body>

<script>
    function onlyAcceptNumber(element) {
        $(element).keypress(function (e) {
        let ASCIIC = e.which ? e.which : e.keyCode;
            if (ASCIIC > '{{ CONDITION_ASCII_CODE }}' && (ASCIIC < '{{ MIN_ASCII_CODE }}' || ASCIIC > '{{ MAX_ASCII_CODE }}'))
                return false;
            return true;
        });
    };

    onlyAcceptNumber('#phoneNid');

    // Loại bỏ class error cũng như hide message lỗi
    $('.form-input, .form-select').each(function(index, item) {
        $(item).change((e) => {
            const parent = $(item).parent();
            let errorInput = null;
            let errorSpan = null;
            errorInput = $(parent).find('.error');
            errorSpan = $(parent).find('.error-message');
            if(errorInput && errorSpan){
                errorInput.removeClass('error');
                errorSpan.css({'opacity': 0, 'visibility': 'hidden'});
            }
        })
    });

    function showErrorMessage(message = null, idDiv = null, idSpan = null){
        $(idDiv).addClass('error');
        $(idSpan).text(message);
        $(idSpan).css({'opacity': 1, 'visibility': 'visible'});
    };

    function clearError(){
        $('#admissionTime').removeClass('error');
        $('#admissionType').removeClass('error');
        $('#phoneNid').removeClass('error');
        $('.error-message').css({'opacity': 0, 'visibility': 'hidden'});
        $('.search-not-found').css({'display': 'none'});
    };

    function resetForm(){
        $('#admissionTime option:first').prop('selected', true);
        $('#admissionType option:first').prop('selected', true);
        $('#phoneNid').val('');
    };

    $('#btnSearchProfile').click((e) => {
        e.preventDefault();
        const csrfToken = '{{ csrf_token() }}';
        $('.loader-page').removeClass('loader-page--hidden');
        $.ajax({
            url: "{{ route('search-profiles.search') }}",
            dataType: "json",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: {
                'admission_time': $('#admissionTime').val().trim(),
                'admission_type': $('#admissionType').val().trim(),
                'phone_nid': $('#phoneNid').val().trim(),
            },
            success: function (result) {
                $('.loader-page').addClass('loader-page--hidden');
                clearError();
                resetForm();
                const code = result?.code;
                const status = result?.status;
                if(code === 'success' && status === true){
                    location.href = "{{ route('search-profiles.preview-info-register') }}";
                }
                else {
                    $('.search-not-found').css({'display': 'block'});
                }
            },
            error: function (xhr, status, error) {
                $('.loader-page').addClass('loader-page--hidden');
                clearError();
                resetForm();
                const errors = xhr.responseJSON.errors;
                if(errors?.admission_time) {
                    showErrorMessage(errors?.admission_time[0], '#admissionTime', '#errAdmissionTime');
                }
                if(errors?.admission_type) {
                    showErrorMessage(errors?.admission_type[0], '#admissionType', '#errAdmissionType');
                }
                if(errors?.phone_nid) {
                    showErrorMessage(errors?.phone_nid[0], '#phoneNid', '#errPhoneNid');
                }
            }
        });
    });
</script>

</html>
