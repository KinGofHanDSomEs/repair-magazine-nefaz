<?php

namespace App\Constants\Errors;

class OrderErrors {
    public const string NOT_FOUND = 'Заказ не найден!';
    public const string NOT_FOUND_USERS = 'Пользователи не найдены!';
    public const string FAILED_UPDATE = 'Введены неверные данные для обновления заказа!';
    public const string EXECUTION_ORDER = 'Заказ выполняется или уже был выполнен!';
    public const string PAID_ORDER = 'Заказ уже оплачен!';
    public const string FAILED_DELETE = 'Введены неверные данне для удаления заказа!';
}
