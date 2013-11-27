<?php
$email = 'test_mail@mail.ru';
$pass1 = 'passwoA2r d';
$pass2 = 'Password1';
$emailVal = new Validator($email);
$emailVal->isEmail('Email format incorrect.');
if ($emailVal->isValid()) {
    echo 'Email:Everything OK<br />';
} else {
    var_dump($emailVal->getErrors());
}

$passVal = new Validator($pass1);
$passVal->isAlnum('Password has to be alnum')
    ->hasFormat('/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})/', 'Password too weak')
    ->isEqual($pass2, 'Passwords dont match');
if ($passVal->isValid()) {
    echo 'Password:Everything OK';
} else {
    var_dump($passVal->getErrors());
}