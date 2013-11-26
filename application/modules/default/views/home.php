<?php
    $email = 'test_mail@1.com';
    $pass = 'Password1';
    $pass1 = 'passasdA2';
    $myValidator = new Validator();
    $myValidator->isEmail($email, 'mail1');
    $myValidator->isPassword($pass, 'pass1');
    $myValidator->isPassword($pass1, 'pass2');
    if($myValidator->isValid)
    {
        echo 'Все ок.';
    }
    else
    {
        var_dump($myValidator->getErrors());
    }
