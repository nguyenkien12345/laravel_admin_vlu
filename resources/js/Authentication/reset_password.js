import $ from 'jquery';

$(document).ready(function () {
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

    function showErrorMessage(message = null, idDiv = null, idSpan = null, inputEle = null) {
        $(idDiv).addClass('error');
        $(idSpan).text(message);
        $(idSpan).css({ 'opacity': 1, 'visibility': 'visible' });
        $(inputEle).addClass('error');
    };

    function clearError() {
        $('.form-input-icon-password').removeClass('error');
        $('#errPassword').text();
        $('#errPassword').css({ 'opacity': 0, 'visibility': 'hidden' });
        $('#password').removeClass('error');
        $('.form-input-icon-cfpassword').removeClass('error');
        $('#errCfpassword').text();
        $('#errCfpassword').css({ 'opacity': 0, 'visibility': 'hidden' });
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
                if (status) {
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
                setTimeout(function () {
                    location.href = "{{ route('users.login') }}";
                }, 1500);
            },
            error: function (xhr, status, error) {
                $('#password').val('');
                $('#passwordConfirmation').val('');
                console.log(xhr.responseJSON);
                const errors = xhr.responseJSON.errors;
                if (errors?.password[0]) {
                    showErrorMessage(errors?.password[0], '.form-input-icon-password', '#errPassword', '#password');
                }
                if (errors?.password_confirmation[0]) {
                    showErrorMessage(errors?.password_confirmation[0], '.form-input-icon-cfpassword', '#errCfpassword', '#passwordConfirmation');
                }
            }
        });
    });
});

