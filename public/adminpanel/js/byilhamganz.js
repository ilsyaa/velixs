var accountUploadImg = $('#account-upload-img')
var accountUploadBtn = $('#account-upload')
var accountUserImage = $('.uploadedAvatar')
var accountResetBtn = $('#account-reset')
if (accountUserImage) {
    var resetImage = accountUserImage.attr('src');
    accountUploadBtn.on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (accountUploadImg) {
                accountUploadImg.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
    });

    accountResetBtn.on('click', function () {
        accountUserImage.attr('src', resetImage);
    });
}

$('#remove-avatar').on('click', function () {
    $('#form-remove-avatar').submit();
});


$(function () {
    'use strict';
    var pageLoginForm = $('.auth-change-email');
    if (pageLoginForm.length) {
        pageLoginForm.validate({
            rules: {
                'email': {
                    required: true,
                    email: true
                },
                'password': {
                    required: true
                }
            }
        });
    }

    var kntl = $('.auth-form-personal');
    if (kntl.length) {
        kntl.validate({
            rules: {
                'username': {
                    required: true,
                    minlength: 5
                },
                'name': {
                    required: true
                }
            }
        });
    }
});

$(document).on('submit', '.auth-form-personal', function () {
    $('.button-personal').prop('disabled', true);
    $('.button-personal').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
});
$(document).on('submit', '.auth-change-email', function () {
    $('.button-fm').prop('disabled', true);
    $('.button-fm').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
});

$(document).on('keyup', 'input[name="username"]', function () {
    var username = $(this).val();
    $(this).val(username.toLowerCase().replace(/[^a-zA-Z0-9_-]/g, ''));
});
