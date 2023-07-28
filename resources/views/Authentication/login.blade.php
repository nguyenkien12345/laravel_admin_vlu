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
    <link rel="stylesheet" href="{{asset('css/Authentication/login.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
    <title>ADMIN VAN LANG</title>
</head>

<body>
    <div class="background" style="background-image: url('../../images/background_login.png')">
        <div class="container-login">
            <div class="container-login-top"></div>

            <div class="container-login-body">
                <div class="circle-icons">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </div>

                <form id="form-login" method="POST" action="{{ route('users.sign-in') }}" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    <div class="form-field">
                        <input type="text" name="phone" id="phone"
                            class="form-input {{$errors->has('phone') ? 'error' : ''}}" placeholder=" "
                            value="{{old('phone')}}">
                        <label for="phone" class="form-label">
                            Số điện thoại <span style="color: red">*</span>
                        </label>
                        <span class="error-message" id="errPhone" @if($errors->has('phone'))
                            style="opacity: 1; visibility: visible;"
                            @endif
                            >
                            @if ($errors->has('phone'))
                            @error('phone')
                            {{ $message }}
                            @enderror
                            @else
                            ERROR
                            @endif
                        </span>
                    </div>

                    <div class="form-field">
                        <div
                            class="form-input-icon {{($errors->has('password') || session('error-password')) ? 'error' : ''}} ">
                            <input type="password" name="password" id="password" class="form-input" placeholder=" ">
                            <i class="far fa-eye" id="showHidePw"></i>
                        </div>
                        <label for="password" class="form-label">
                            Mật khẩu <span style="color: red">*</span>
                        </label>
                        <span class="error-message" id="errPassword" @if($errors->has('password') ||
                            session('error-password'))
                            style="opacity: 1; visibility: visible;"
                            @endif
                            >
                            @if ($errors->has('password'))
                            @error('password')
                            {{ $message }}
                            @enderror
                            @elseif(session('error-password'))
                            {{session('error-password')}}
                            @else
                            ERROR
                            @endif
                        </span>
                    </div>

                    <button id="btnLogin" type="submit">Đăng nhập</button>
                </form>
            </div>

            <div class="container-login-footer">
                <a id="forgotPassword" href="{{ route('users.forgot-password') }}">Quên mật khẩu</a>
                <a id="btnRegister" href="{{ route('users.register') }}">Đăng ký</a>
            </div>
        </div>
    </div>
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

    function formatLengthPhone(element){
        $(element).keyup(function(){
            let value = $(this).val().trim();
            $(this).val(value.slice(0, 10));
        })
    };

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
</script>

</html>
