import $ from 'jquery';

$(document).ready(function () {
    function onlyAcceptNumber(element) {
        $(element).keypress(function (e) {
            let ASCIIC = e.which ? e.which : e.keyCode;
            if (ASCIIC > '{{ CONDITION_ASCII_CODE }}' && (ASCIIC < '{{ MIN_ASCII_CODE }}' || ASCIIC > '{{ MAX_ASCII_CODE }}'))
                return false;
            return true;
        });
    };

    function formatLengthOtp(element) {
        $(element).keyup(function () {
            let value = $(this).val().trim();
            $(this).val(value.slice(0, 6));
        })
    };

    onlyAcceptNumber('#otp');
    formatLengthOtp('#otp');

    function countdown() {
        const resentOtp = $('#resendOtp');
        resentOtp.prop('disabled', true);
        resentOtp.css({ 'color': '#ccc', 'cursor': 'not-allowed' });
        const timer = $('#timer').text();
        let seconds = parseInt(timer);

        let timeout;
        if (seconds <= 0) {
            clearTimeout(timeout);
            resentOtp.prop('disabled', false);
            resentOtp.css({ 'color': '#000000', 'cursor': 'pointer' });
        } else {
            seconds--;
            $('#timer').text(seconds);
            timeout = setTimeout(countdown, 1000);
        }
    };

    countdown();

    // Loại bỏ class error cũng như hide message lỗi
    $('.form-input').each(function (index, item) {
        $(item).change((e) => {
            const parent = $(item).parent();
            let errorInput = null;
            let errorSpan = null;
            if (parent.hasClass('form-input-icon')) {
                errorInput = $(parent);
                errorSpan = $(parent).parent().find('.error-message');
            }
            else {
                errorInput = $(parent).find('.error');
                errorSpan = $(parent).find('.error-message');
            }
            if (errorInput && errorSpan) {
                errorInput.removeClass('error');
                errorSpan.css({ 'opacity': 0, 'visibility': 'hidden' });
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
                if (status) {
                    countdown();
                }
            },
            error: function (xhr, status, error) {
            }
        });
    });

    function showErrorMessage(message = null) {
        $('.form-input').addClass('error');
        $('.error-message').text(message);
        $('.error-message').css({ 'opacity': 1, 'visibility': 'visible' });
        $('#otp').addClass('error');
    };

    function clearError() {
        $('.form-input').removeClass('error');
        $('.error-message').text();
        $('.error-message').css({ 'opacity': 0, 'visibility': 'hidden' });
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
                if (status) {
                    clearError();
                    Swal.fire({
                        title: 'Thành công',
                        text: "OTP hợp lệ",
                        icon: 'success',
                        showCloseButton: false,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                    setTimeout(function () {
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
                if (message) {
                    showErrorMessage(message);
                }
            }
        });
    });
});
