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

    function formatLengthPhone(element) {
        $(element).keyup(function () {
            let value = $(this).val().trim();
            $(this).val(value.slice(0, 10));
        })
    };

    onlyAcceptNumber('#phone');
    formatLengthPhone('#phone');

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

    function clearError() {
        $('.error-message').text();
        $('.error-message').css({ 'opacity': 0, 'visibility': 'hidden' });
        $('#phone').removeClass('error');
    }

    function showErrorMessage(message = null) {
        $('.error-message').text(message);
        $('.error-message').css({ 'opacity': 1, 'visibility': 'visible' });
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
                if (status) {
                    $('#form-forgotpassword').submit();
                }
                else {
                    showErrorMessage('Có lỗi trong quá trình gửi otp');
                }
            },
            error: function (xhr, status, error) {
                const errors = xhr.responseJSON.errors;
                const message = errors?.phone[0];
                if (message) {
                    showErrorMessage(message);
                }
            }
        });
    });
});
