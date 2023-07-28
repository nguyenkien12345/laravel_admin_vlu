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
    <link rel="stylesheet" href="{{asset('css/Authentication/send_otp.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
    <title>ADMIN VAN LANG</title>
</head>

<body>
    <div class="background" style="background-image: url('../../images/background_login.png')">
        <div class="container-sendotp">
            <div class="container-sendotp-top"></div>

            <div class="container-sendotp-body">
                <div class="circle-icons">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </div>

                <div class="wrapper-sendotp">
                    <p class="title">Mã OTP đã được gửi qua số {{ str_replace(substr($phone, 0, 6), '******', $phone) }}
                    </p>
                    <form id="form-sendotp" method="POST" @if
                        ($type===config("authentication.send_otp.forgot_password"))
                        action="{{ route('users.show-form-reset-password') }}" : @else
                        action="{{ route('users.store') }}" @endif enctype="multipart/form-data" novalidate>
                        @csrf
                        <input type="hidden" id="phone" name="phone" value="{{$phone}}" />
                        <input type="hidden" id="type" name="type" value="{{$type}}" />
                        <div class="form-field">
                            <input type="text" name="otp" id="otp" class="form-input" placeholder=" ">
                            <label for="otp" class="form-label">
                                Mã OTP <span style="color: red">*</span>
                            </label>
                        </div>
                        <p class="information">
                            Mã OTP sẽ hết hạn sau
                            <b id="timer" style="color: red;">60</b>s.
                            <button id="resendOtp"
                                style="color: black; text-decoration: underline; padding-left: 5px">Gửi lại</button>.
                        </p>

                        <div class="buttons">
                            <button id="btnCancel" type="button">Hủy</button>
                            <button id="btnSendotp" type="button">Tiếp tục</button>
                        </div>
                    </form>
                </div>
            </div>

            <span class="error-message">ERROR</span>
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

    function formatLengthOtp(element){
        $(element).keyup(function(){
            let value = $(this).val().trim();
            $(this).val(value.slice(0, 6));
        })
    };

    onlyAcceptNumber('#otp');
    formatLengthOtp('#otp');

    function countdown() {
        const resentOtp =  $('#resendOtp');
        resentOtp.prop('disabled', true);
        resentOtp.css({'color': '#ccc', 'cursor': 'not-allowed'});
        const timer = $('#timer').text();
        let seconds = parseInt(timer);

        let timeout;
        if (seconds <= 0) {
            clearTimeout(timeout);
            resentOtp.prop('disabled', false);
            resentOtp.css({'color': '#000000', 'cursor': 'pointer'});
        } else {
            seconds--;
            $('#timer').text(seconds);
            timeout = setTimeout(countdown, 1000);
        }
    };

    countdown();

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

    $('#resendOtp').click((e) => {
        clearError();
        $('#otp').val('');
        $('#timer').text(parseInt(60));
        e.preventDefault();
        const csrfToken = '{{ csrf_token() }}';
        const type = "{!! config('authentication.send_otp.resend') !!}";
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
                const status = result?.status;
                if(status){
                    countdown();
                }
            },
            error: function (xhr, status, error) {
            }
        });
    });

    function showErrorMessage(message = null){
        $('.form-input').addClass('error');
        $('.error-message').text(message);
        $('.error-message').css({'opacity': 1, 'visibility': 'visible'});
        $('#otp').addClass('error');
    };

    function clearError(){
        $('.form-input').removeClass('error');
        $('.error-message').text();
        $('.error-message').css({'opacity': 0, 'visibility': 'hidden'});
        $('#otp').removeClass('error');
    };

    $('#btnSendotp').click((e) => {
        e.preventDefault();
        const csrfToken = '{{ csrf_token() }}';
        $.ajax({
            url: '{{ route("users.verify-otp") }}',
            dataType: "json",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: {
                'phone': $('#phone').val().trim(),
                'type': $('#type').val().trim(),
                'otp': $('#otp').val().trim(),
            },
            success: function (result) {
                const { message, status } = result;
                if(status){
                    clearError();
                    Swal.fire({
                        title: 'Thành công',
                        text: "OTP hợp lệ",
                        icon: 'success',
                        showCloseButton: false,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                    setTimeout(function(){
                        $('#form-sendotp').submit();
                    }, 1500);
                }
                else {
                    showErrorMessage(message);
                }
            },
            error: function (xhr, status, error) {
                const errors = xhr.responseJSON.errors;
                const message = errors?.otp[0];
                if(message) {
                    showErrorMessage(message);
                }
            }
        });
    });
</script>

</html>
