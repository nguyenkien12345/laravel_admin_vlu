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
    <link rel="stylesheet" href="{{asset('css/Authentication/forgot_password.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
    <title>ADMIN VAN LANG</title>
</head>

<body>
    <div class="background" style="background-image: url('../../images/background_login.png');">
        <div class="container-forgotpassword">
            <div class="container-forgotpassword-top"></div>

            <div class="container-forgotpassword-body">
                <div class="circle-icons">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </div>

                <div class="wrapper-forgotpassword">
                    <p class="title">Nhập số điện thoại của bạn</p>

                    <form id="form-forgotpassword" method="POST" action="{{ route('users.show-form-verify-otp') }}"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <input type="hidden" name="type" id="type"
                            value="{{ config('authentication.send_otp.forgot_password') }}">
                        <div class="form-field">
                            <input type="text" name="phone" id="phone" class="form-input" placeholder=" ">
                            <label for="phone" class="form-label">
                                Số điện thoại <span style="color: red">*</span>
                            </label>
                            <span class="error-message">ERROR</span>
                        </div>

                        <div class="buttons">
                            <button id="btnCancel" type="button">Hủy</button>
                            <button id="btnForgotpassword" type="button">Tiếp tục</button>
                        </div>
                    </form>
                </div>
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
            text: "Bạn có chắc chắn muốn hủy tiến trình ?",
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

    function clearError(){
        $('.error-message').text();
        $('.error-message').css({'opacity': 0, 'visibility': 'hidden'});
        $('#phone').removeClass('error');
    }

    function showErrorMessage(message = null){
        $('.error-message').text(message);
        $('.error-message').css({'opacity': 1, 'visibility': 'visible'});
        $('#phone').addClass('error');
    }

    $('#btnForgotpassword').click((e) => {
        e.preventDefault();
        const type = "{!! config('authentication.send_otp.forgot_password') !!}";
        const csrfToken = '{{ csrf_token() }}';
        $.ajax({
            url: '{{ route("users.send-otp") }}',
            dataType: "json",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: {
                'phone': $('#phone').val().trim(),
                'type': type,
            },
            success: function (result) {
                clearError();
                const status = result?.status;
                if(status){
                    $('#form-forgotpassword').submit();
                }
                else {
                    showErrorMessage('Có lỗi trong quá trình gửi otp');
                }
            },
            error: function (xhr, status, error) {
                const errors = xhr.responseJSON.errors;
                const message = errors?.phone[0];
                if(message) {
                    showErrorMessage(message);
                }
            }
        });
    });
</script>

</html>
