$(document).ready(function () {

    $('.thumb').first().addClass('selected');
    var path = $('.selected').attr('src');
    path = path.replace('/thumb/', '/orig/');
    $('#main img').attr('src', path);
    setInputs();


    $('.thumb').bind('click', function () {
        $('.thumb').removeClass('selected');
        $(this).addClass('selected');
        var path = $('.selected').attr('src');
        path = path.replace('/thumb/', '/orig/');
        $('#main img').attr('src', path);
        setInputs();
    });

    $('#inputs input').focus(function () {
        if ($(this).hasClass('initial'))
            $(this).removeClass('initial').val('');
    });

    $('#inputs input').focusout(function () {
        if ($(this).val() == '')
            $(this).addClass('initial').val($(this).attr('id'));
    });

    function setInputs() {
        $('#inputs input').hide();
        var inputs = $('.selected').attr('inputs');
        for (var i = 1; i <= inputs; i++) {
            $('#inputs #' + i).show();
            $('#inputs #' + i).val(i).addClass('initial');
        }
    };

    $('input[type*="button"]').bind('click', function () {
        var inputs = $('#inputs input');
        var inputsVal = new Array();
        var path = $('#main img').attr('src');

        for (var i = 0; i < inputs.length; i++) {
            if ($(inputs[i]).hasClass('initial')) {
                $(inputs[i]).val('');
            } else if ($(inputs[i]).is(':visible') && $.trim($(inputs[i]).val()) != '') {
                inputsVal[i] = $.trim($(inputs[i]).val());
            }
        }


        if (inputsVal.length < 1) {
            alert('Заполните хотя бы одно поле!');
            setInputs();
        } else {
            var div = $('<div></div>').addClass('darkened');
            $('body').append(div);
            $('#ajax').show();
            var current = window.location.href;
            $.post(current.replace('create', 'generate'), {text: inputsVal, path: path})
                .done(function () {
                    window.location.replace(current.replace('create', 'view'));
                })
        }

    });


});