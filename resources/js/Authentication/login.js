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
});
