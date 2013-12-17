function BadMethodException(message) {
    this.name = 'BadMethod';
    this.message = message;
}
/**
 *
 * @type {{field_value: string,
 * array: Array,  массив обьектов со свойствами name_of_method, breakOnFailure,
 * empty: Function, length_between: Function, field_pattern: Function, isMethodExists: Function, add: Function, setValueToArray: Function, run: Function}}
 */
var Validator = {
    field_value: '',
    array: [],

    empty: function () {
        if (this.field_value == '')
            return "Заполните поле ! ";
        else return '';
    },
    length_between: function (params) {
        if (this.field_value.length > params.max || this.field_value.length < params.min)
            return "Максимальная длинна поля " + params.max + ", минимальная " + params.min + " !";
        else return '';
    },

    field_pattern: function (params) {
        var reg = new RegExp(params.pattern);
        if (!reg.test(this.field_value))
            return params.message;
        else return '';
    },
    equals: function (params){
        if(params.value_1 != params.value_2)
            return params.message;
        else return '';
    },
    empty_all_fields: function(params){
        var message='';
        for(var i in params.array)
        {
            message+=params.array[i];
        }
        if(message=='')
            return params.message;
        else return '';
    },
    isMethodExists: function (method) {
        if (!(method in Validator))
            throw new BadMethodException('Метод ' + method + ' не существует. Проверьте синтаксис! ');
    },

    /**
     *
     * @param name_of_method
     * @param chain если true - в случае если поле не валидно прервать цепочку валидаторов.
     */
    add: function (name_of_method, breakOnFailure, array_of_params) {
        var obj = {name: name_of_method, chain: breakOnFailure, params: array_of_params};
        this.setValueToArray(obj);
    },
    setValueToArray: function (obj) {
        Validator.array [this.array.length] = obj;
    },
    run: function () {
        var error_message = '';
        var stack_of_messages = {};

        try {
            if (this.array.length > 0) {
                for (var i = 0; i < Validator.array.length; i++) {
                    var validation_method = Validator.array[i];
                    this.isMethodExists(validation_method.name);
                    if (validation_method.params != undefined) {
                        error_message = Validator[validation_method.name](validation_method.params);
                    } else {
                        error_message = Validator[validation_method.name]();
                    }
                    console.log("Name: " + validation_method.name);
                    console.log("Message: " + error_message);
                    if (error_message != '') {
                        if (validation_method.chain == 'true') {
                            stack_of_messages[validation_method.name]=error_message;
                            return stack_of_messages;
                        } else {
                            stack_of_messages[validation_method.name]=error_message;
                        }
                    }

                }

            }
        } catch (e) {
            alert(e.message);
            return;
        }
        finally {
            this.array.length = 0;
        }
        return stack_of_messages;
    }


}

$(function () {
   // $("#global_error_message_container").hide();
    $("#username").focus();

    $("#reg_form").submit(function () {
        var data_ok = true;

        var username = $("#username").val();
        Validator.field_value = username;
        Validator.add('empty', 'true');
        Validator.add('field_pattern', '',
            {pattern:'^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$',
                message: 'Поле не валидно!'
            });

        var username_message = Validator.run();
        if (!$.isEmptyObject(username_message)) {
            data_ok = false;
            show_error_message(username_message, 'username');
        }
        else {
              hide_error_message('username');
        }

        var password_1 = $("#password_1").val();
        Validator.field_value = password_1;
        Validator.add('empty', 'true');
        Validator.add('length_between', '', {max: 16, min: 8});
        Validator.add('field_pattern', '',
            {pattern:'([a-zA-Z]+[0-9]+)|([0-9]+[a-zA-Z]+)',
                message: 'Поле должно содержать по крайней мере 1 символ и 1 цифру !'
            });

        var password_1_message = Validator.run();
        if (!$.isEmptyObject(password_1_message)) {
            data_ok = false;
            show_error_message(password_1_message, 'password_1');
        }
        else {
               hide_error_message('password_1');
        }

        var password_2 = $("#password_2").val();
        Validator.field_value = password_2;
        Validator.add('empty', 'true');
        Validator.add('equals', '',
            {value_1:password_1, value_2:password_2,
                message: 'Пароли не совпадают !'
            });

        var password_2_message = Validator.run();
        if (!$.isEmptyObject(password_2_message)) {
            data_ok = false;
            show_error_message(password_2_message, 'password_2');
        }
        else {
              hide_error_message('password_2');
        }


        var email = $("#email").val();
        Validator.field_value = email;
        Validator.add('empty', 'true');
        Validator.add('field_pattern', '',
            {pattern:/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
                message: 'Неверный email !'
            });

        var email_message = Validator.run();
        if (!$.isEmptyObject(email_message)) {
            data_ok = false;
            show_error_message(email_message, 'email');
        }
        else {
              hide_error_message('email');
        }

        var date_of_birthday = $("#date_of_birthday").val();
        Validator.field_value = date_of_birthday;
        Validator.add('empty', 'true');
        Validator.add('field_pattern', '',
            {pattern:/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/,
                message: 'Дата не соответствует шаблону !'
            });

        var date_of_birthday_message = Validator.run();
        if (!$.isEmptyObject(date_of_birthday_message)) {
            data_ok = false;
            show_error_message(date_of_birthday_message, 'date_of_birthday');
        }
        else {
              hide_error_message('date_of_birthday');
        }

        Validator.add('empty_all_fields','',{
            array:[username,password_1,password_2,email,date_of_birthday],
            message:"Звездочки (*) обозначают поля, которые нужно заполнить"});
        var e_mess=Validator.run();
        if(!$.isEmptyObject(e_mess)){
            show_global_error_message(e_mess);
        }//else{
           //   hide_global_error_message();
      //  }

        if (data_ok) {
            // hide_global_error_message();
            alert('Everything is OK... so far.')
        }
        return data_ok; // отправка данных на сервер
    });
});


function show_error_message(messages, field_name) {
    var message='';
    for(var i in messages){
        message+=messages[i]+'</br>';
    }
    $('#' + field_name + '_message').html(message);
    // if ($('#' + field_name + '_message_container').is(':hidden')) {
    $('#' + field_name + '_message_container').show(2000);
    // }

}

function show_global_error_message(messages) {
    var message='';
    for(var i in messages){
        message+=messages[i]+'</br>';
    }
    $("#global_error_message").text(message);
    // if ($('#global_error_message_container').is(':hidden')) {
    $('#global_error_message_container').show('medium');
    //}
}

function hide_error_message(field_name) {
    $('#' + field_name + '_message_container').hide("slow");
}

function hide_global_error_message() {
    if ($('#global_error_message_container').is(':visible')) {
        $('#global_error_message_container').hide('medium');
    }
}

