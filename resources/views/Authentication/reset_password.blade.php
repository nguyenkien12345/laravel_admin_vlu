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
    <link rel="stylesheet" href="{{asset('css/Authentication/reset_password.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
    <title>ADMIN VAN LANG</title>
</head>

<body>
    <div class="background" style="background-image: url('../../images/background_login.png');">
        <div class="container-resetpassword">
            <div class="container-resetpassword-top"></div>

            <div class="container-resetpassword-body">
                <div class="circle-icons">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </div>

                <div class="wrapper-resetpassword">
                    <p class="title">Nhập mật khẩu mới của bạn</p>

                    <form id="form-resetpassword" method="POST" action="{{ route('users.reset-password') }}"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <input type="hidden" id="phone" name="phone" value="{{$phone}}" />
                        <div class="form-field">
                            <div class="form-input-icon form-input-icon-password">
                                <input type="password" name="password" id="password" class="form-input"
                                    placeholder=" " />
                                <i class="far fa-eye" id="showHidePw"></i>
                            </div>
                            <label for="password" class="form-label">
                                Mật khẩu <span style="color: red">*</span>
                            </label>
                            <span class="error-message" id="errPassword">ERROR</span>
                        </div>

                        <div class="form-field">
                            <div class="form-input-icon form-input-icon-cfpassword">
                                <input type="password" name="password_confirmation" id="passwordConfirmation"
                                    class="form-input" placeholder=" " />
                                <i class="far fa-eye" id="showHidePwCf"></i>
                            </div>
                            <label for="passwordConfirmation" class="form-label">
                                Nhập lại mật khẩu <span style="color: red">*</span>
                            </label>
                            <span class="error-message" id="errCfpassword">ERROR</span>
                        </div>

                        <div class="buttons">
                            <button id="btnCancel" type="button">Hủy</button>
                            <button id="btnResetPassword" type="button">Tiếp tục</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>

<script>
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

    $('#btnCancel').click((e) => {
        Swal.fire({
            title: 'Hủy',
            text: "Bạn có chắc chắn muốn hủy quá trình thay đổi mật khẩu ?",
            icon: 'warning',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
            // reverseButtons: true,
            focusConfirm: false,
        })
        .then((result) => {
            if (result.isConfirmed) {
                location.href = "{{ route('users.login') }}";
            }
        })
    });

    function showErrorMessage(message = null, idDiv = null, idSpan = null, inputEle = null){
        $(idDiv).addClass('error');
        $(idSpan).text(message);
        $(idSpan).css({'opacity': 1, 'visibility': 'visible'});
        $(inputEle).addClass('error');
    };

    function clearError(){
        $('.form-input-icon-password').removeClass('error');
        $('#errPassword').text();
        $('#errPassword').css({'opacity': 0, 'visibility': 'hidden'});
        $('#password').removeClass('error');
        $('.form-input-icon-cfpassword').removeClass('error');
        $('#errCfpassword').text();
        $('#errCfpassword').css({'opacity': 0, 'visibility': 'hidden'});
        $('#passwordConfirmation').removeClass('error');
    };

    $('#btnResetPassword').click((e) => {
        e.preventDefault();
        const csrfToken = '{{ csrf_token() }}';
        $.ajax({
            url: '{{ route("users.reset-password") }}',
            dataType: "json",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: {
                'phone': $('#phone').val().trim(),
                'password': $('#password').val().trim(),
                'password_confirmation': $('#passwordConfirmation').val().trim(),
            },
            success: function (result) {
                clearError();
                const options = {
                    showCloseButton: false,
                    showCancelButton: false,
                    showConfirmButton: false
                };
                const { message, status } = result;
                if(status){
                    Swal.fire({
                        title: 'Thành công',
                        text: message,
                        icon: 'success',
                        ...options
                    })
                }
                else {
                    Swal.fire({
                        title: 'Thất bại',
                        text: message,
                        icon: 'danger',
                        ...options
                    })
                }
                setTimeout(function(){
                    location.href = "{{ route('users.login') }}";
                }, 1500);
            },
            error: function (xhr, status, error) {
                $('#password').val('');
                $('#passwordConfirmation').val('');
                console.log(xhr.responseJSON);
                const errors = xhr.responseJSON.errors;
                if(errors?.password[0]) {
                    showErrorMessage(errors?.password[0], '.form-input-icon-password', '#errPassword', '#password');
                }
                if(errors?.password_confirmation[0]){
                    showErrorMessage(errors?.password_confirmation[0], '.form-input-icon-cfpassword', '#errCfpassword', '#passwordConfirmation');
                }
            }
        });
    });
</script>

</html>
