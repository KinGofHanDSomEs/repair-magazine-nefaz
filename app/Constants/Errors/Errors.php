<?php

namespace App\Constants\Errors;

class ValidationErrors
{
    public const string REQUIRED = 'Поле должно быть заполнено!';
    public const string STRING = 'Значение поля должно являться строкой!';
    public const string EMAIL = 'Неверное написание электронной почты!';
    public const string UNIQUE = 'Пользователь с такой почтой уже существует!';
    public const string MAX = 'Слишком длинный текст, используйте не больше :max символов!';
    public const string MIN = 'Слишком короткий текст, используйте не меньше :min символов!';
    public const string CONFIRMED = 'Пароли не совпадают!';
}

class AuthErrors {
    public const string INVALID_ARGUMENTS = 'Неверная почта или пароль!';
}

class SystemErrors {
    public const string INTERNAL = 'Ошибка внутри сервера!';
}

