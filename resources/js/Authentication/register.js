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

    function formatLengthPhone(element) {
        $(element).keyup(function () {
            let value = $(this).val().trim();
            $(this).val(value.slice(0, 10));
        })
    };

    onlyAcceptAlphabetic('#name');
    onlyAcceptNumber('#phone');
    formatLengthPhone('#phone');

    function showHidePassword(elementClick, elementChange) {
        $(elementClick).click((e) => {
            const showHidePw = $(elementClick);
            const password = $(elementChange);
            const iconShow = 'fa-eye';
            const iconHide = 'fa-eye-slash';
            const typePassword = 'password';
            const typeText = 'text';
            if (password.attr('type') === typePassword) {
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

    function showErrorMessage(message = null, idDiv = null, idSpan = null) {
        $(idDiv).addClass('error');
        $(idSpan).text(message);
        $(idSpan).css({ 'opacity': 1, 'visibility': 'visible' });
    };

    function clearError() {
        $('#name').removeClass('error');
        $('#phone').removeClass('error');
        $('#email').removeClass('error');
        $('#formInputIconPW').removeClass('error');
        $('#formInputIconCfPW').removeClass('error');
        $('.error-message').css({ 'opacity': 0, 'visibility': 'hidden' });
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
                if (status) {
                    $('#form-register').submit();
                }
            },
            error: function (xhr, status, error) {
                clearError();
                const errors = xhr.responseJSON.errors;
                if (errors?.name) {
                    showErrorMessage(errors?.name[0], '#name', '#errName');
                }
                if (errors?.phone) {
                    showErrorMessage(errors?.phone[0], '#phone', '#errPhone');
                }
                if (errors?.email) {
                    showErrorMessage(errors?.email[0], '#email', '#errEmail');
                }
                if (errors?.password) {
                    $('#password').val('');
                    $('#passwordConfirmation').val('');
                    showErrorMessage(errors?.password[0], '#formInputIconPW', '#errPassword');
                }
                if (errors?.password_confirmation) {
                    $('#password').val('');
                    $('#passwordConfirmation').val('');
                    showErrorMessage(errors?.password_confirmation[0], '#formInputIconCfPW', '#errCfpassword');
                }
            }
        });
    });
});
