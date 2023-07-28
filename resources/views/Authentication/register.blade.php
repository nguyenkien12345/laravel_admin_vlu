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
    <link rel="stylesheet" href="{{asset('css/Authentication/register.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
    <title>ADMIN VAN LANG</title>
</head>

<body>
    <div class="background" style="background-image: url('../../images/background_login.png')">
        <div class="container-register">
            <div class="container-register-top"></div>

            <div class="container-register-body">
                <div class="circle-icons">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </div>

                <form id="form-register" method="POST" action="{{ route('users.show-form-verify-otp') }}"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="type" id="type" value="{{ config('authentication.send_otp.register') }}">
                    <div class="form-field">
                        <input autocomplete="off" type="text" name="name" id="name" class="form-input" placeholder=" "
                            value="{{old('name')}}" />
                        <label for="name" class="form-label">Họ và Tên <span style="color: red">*</span></label>
                        <span class="error-message" id="errName">ERROR</span>
                    </div>

                    <div class="form-field">
                        <input autocomplete="off" type="text" name="phone" id="phone" class="form-input" placeholder=" "
                            value="{{old('phone')}}" />
                        <label for="phone" class="form-label">Số điện thoại <span style="color: red">*</span></label>
                        <span class="error-message" id="errPhone">ERROR</span>
                    </div>

                    <div class="form-field">
                        <input autocomplete="off" type="email" name="email" id="email" class="form-input"
                            placeholder=" " value="{{old('email')}}" />
                        <label for="email" class="form-label">Email <span style="color: red">*</span></label>
                        <span class="error-message" id="errEmail">ERROR</span>
                    </div>

                    <div class="form-field">
                        <div class="form-input-icon" id="formInputIconPW">
                            <input autocomplete="off" type="password" name="password" id="password" class="form-input"
                                placeholder=" " value="{{old('password')}}" />
                            <i class="far fa-eye" id="showHidePw"></i>
                        </div>
                        <label for="password" class="form-label">Mật khẩu <span style="color: red">*</span></label>
                        <span class="error-message" id="errPassword">ERROR</span>
                    </div>

                    <div class="form-field">
                        <div class="form-input-icon" id="formInputIconCfPW">
                            <input autocomplete="off" type="password" name="password_confirmation"
                                id="passwordConfirmation" class="form-input" placeholder=" "
                                value="{{old('password_confirmation')}}">
                            <i class="far fa-eye" id="showHidePwCf"></i>
                        </div>
                        <label for="passwordConfirmation" class="form-label">
                            Nhập lại mật khẩu <span style="color: red">*</span>
                        </label>
                        <span class="error-message" id="errCfpassword">ERROR</span>
                    </div>

                    <button id="btnRegister" type="button">Đăng ký</button>
                </form>
            </div>

            <span class="has-account">Đã có tài khoản? <a href="{{ route('users.login') }}">Đăng nhập</a></span>
        </div>
    </div>
</body>

<script>
    function onlyAcceptNumber(element) {
        $(element).keypress(function (e) {
        let ASCIIC = e.which ? e.which : e.keyCode;
            // 31   48  57
            if (ASCIIC > '{{ CONDITION_ASCII_CODE }}' && (ASCIIC < '{{ MIN_ASCII_CODE }}' || ASCIIC > '{{ MAX_ASCII_CODE }}'))
                return false;
            return true;
        });
    };

    function onlyAcceptAlphabetic(element) {
        $(element).keypress(function (event) {
                let regex = /[^(\d\[\]!@#$%^&*\(\)_+\-={};':"\\|,\.<>\/?)]/;
                let key = String.fromCharCode(event.charCode ? event.charCode : event.which);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
    };

    function formatLengthPhone(element){
        $(element).keyup(function(){
            let value = $(this).val().trim();
            $(this).val(value.slice(0, 10));
        })
    };

    onlyAcceptAlphabetic('#name');
    onlyAcceptNumber('#phone');
    formatLengthPhone('#phone');

    function showHidePassword(elementClick, elementChange){
        $(elementClick).click((e) => {
            const showHidePw = $(elementClick);
            const password = $(elementChange);
            const iconShow = 'fa-eye';
            const iconHide = 'fa-eye-slash';
            const typePassword = 'password';
            const typeText = 'text';
            if(password.attr('type') === typePassword){
                $(showHidePw).removeClass(iconShow).addClass(iconHide);
                password.attr('type', typeText);
            }
            else {
                $(showHidePw).removeClass(iconHide).addClass(iconShow);
                password.attr('type', typePassword);
            }
        });
    };

    showHidePassword('#showHidePw', '#password');
    showHidePassword('#showHidePwCf', '#passwordConfirmation');

    // Loại bỏ class error cũng như hide message lỗi
    $('.form-input').each(function(index, item) {
        $(item).change((e) => {
            const parent = $(item).parent();
            let errorInput = null;
            let errorSpan = null;
            if(parent.hasClass('form-input-icon')) {
                errorInput = $(parent);
                errorSpan = $(parent).parent().find('.error-message');
            }
            else {
                errorInput = $(parent).find('.error');
                errorSpan = $(parent).find('.error-message');
            }
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
        $('#name').removeClass('error');
        $('#phone').removeClass('error');
        $('#email').removeClass('error');
        $('#formInputIconPW').removeClass('error');
        $('#formInputIconCfPW').removeClass('error');
        $('.error-message').css({'opacity': 0, 'visibility': 'hidden'});
    };

    $('#btnRegister').click((e) => {
        e.preventDefault();
        const type = "{!! config('authentication.send_otp.register') !!}";
        const csrfToken = '{{ csrf_token() }}';
        $.ajax({
            url: '{{ route("users.send-otp") }}',
            dataType: "json",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: {
                'name': $('#name').val().trim(),
                'phone': $('#phone').val().trim(),
                'email': $('#email').val().trim(),
                'password': $('#password').val().trim(),
                'password_confirmation': $('#passwordConfirmation').val().trim(),
                'type': type,
            },
            success: function (result) {
                clearError();
                const status = result?.status;
                if(status){
                    $('#form-register').submit();
                }
            },
            error: function (xhr, status, error) {
                clearError();
                const errors = xhr.responseJSON.errors;
                if(errors?.name) {
                    showErrorMessage(errors?.name[0], '#name', '#errName');
                }
                if(errors?.phone) {
                    showErrorMessage(errors?.phone[0], '#phone', '#errPhone');
                }
                if(errors?.email) {
                    showErrorMessage(errors?.email[0], '#email', '#errEmail');
                }
                if(errors?.password) {
                    $('#password').val('');
                    $('#passwordConfirmation').val('');
                    showErrorMessage(errors?.password[0], '#formInputIconPW', '#errPassword');
                }
                if(errors?.password_confirmation) {
                    $('#password').val('');
                    $('#passwordConfirmation').val('');
                    showErrorMessage(errors?.password_confirmation[0], '#formInputIconCfPW', '#errCfpassword');
                }
            }
        });
    });
</script>

</html>
