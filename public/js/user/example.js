$(document).ready(function () {
    $('.password-condition').hide();
    $('.password-input').focus(function () {
        $('.password-condition').show('slow');
    });
    $('.password-input').blur(function () {
        $('.password-condition').hide('slow');
    });
});