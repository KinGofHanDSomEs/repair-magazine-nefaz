<?php

namespace App\Constants\Errors;

class ValidationErrors
{
    public const string REQUIRED = 'Поле должно быть заполнено!';
    public const string STRING = 'Значение поля должно являться строкой!';
    public const string INTEGER = 'Значение поля должно являться числом!';

    public const string EMAIL = 'Неверное написание электронной почты!';
    public const string UNIQUE = 'Пользователь с такой почтой уже существует!';
    public const string MIN = 'Используйте не менее :min символов!';
    public const string MAX = 'Используйте не более :max символов!';
    public const string INTEGER_MIN = 'Число должно быть не меньше :min';
    public const string INTEGER_MAX = 'Число должно быть не больше :max';
    public const string CONFIRMED = 'Пароли не совпадают!';
    public const string EXISTS = 'Такой записи не существует!';
}
