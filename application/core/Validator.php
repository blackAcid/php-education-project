<?php


class Validator
{
    private $errorsStack;
    public $isValid = true;

    public function isEmail($input, $alias)
    {
        if (!is_string($input) || filter_var($input, FILTER_VALIDATE_EMAIL) == false) {
            $this->errorsStack[$alias] = 'Email введен неверно.';
            $this->isValid = false;
        }
    }

    public function isPassword($input, $alias)
    {
        if (preg_match('/\s/', $input)) {
            $this->errorsStack[$alias][] = 'Пароль не может содержать пробелы.';
            $this->isValid = false;
        }

        if (!preg_match('/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})/', $input)) {
            if (!preg_match('/[a-z]/', $input)) {
                $this->errorsStack[$alias][] = 'Пароль должен содержать хотя бы одну строчную букву.';
                $this->isValid = false;
            }

            if (!preg_match('/[A-Z]/', $input)) {
                $this->errorsStack[$alias][] = 'Пароль должен содержать хотя бы одну заглавную букву.';
                $this->isValid = false;
            }

            if (!preg_match('/\d/', $input)) {
                $this->errorsStack[$alias][] = 'Пароль должен содержать хотя бы одну цифру.';
                $this->isValid = false;
            }
        }
    }

    public function getErrors()
    {
            return $this->errorsStack;
    }

}