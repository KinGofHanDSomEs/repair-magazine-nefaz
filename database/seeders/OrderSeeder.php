<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            ['user_id' => '2', 'type_id' => '1', 'status' => 'Проверяется', 'count' => '2', 'payment_status' => 'Ожидание'],
            ['user_id' => '2', 'type_id' => '2', 'status' => 'Оценено', 'count' => '1', 'price' => '50000', 'payment_status' => 'Ожидание'],
            ['user_id' => '2', 'type_id' => '3', 'status' => 'Выполняется', 'count' => '1', 'price' => '30000', 'payment_status' => 'Успешно'],
            ['user_id' => '2', 'type_id' => '4', 'status' => 'Завершено', 'count' => '2', 'price' => '60000', 'payment_status' => 'Успешно', 'completed_at' => '2026-02-10 14:10:12'],
            ['user_id' => '2', 'type_id' => '5', 'status' => 'Ошибка', 'count' => '3', 'payment_status' => 'Ожидание', 'failed_message' => 'Не подлежит восстановлению'],
            ['user_id' => '2', 'type_id' => '6', 'status' => 'Оценено', 'count' => '3', 'price' => '75000', 'payment_status' => 'Ошибка', 'failed_message' => 'Ошибка оплаты'],
            ['user_id' => '2', 'type_id' => '6', 'status' => 'Оценено', 'count' => '1', 'price' => '35000', 'payment_status' => 'Успешно'],

            ['user_id' => '2', 'type_id' => '1', 'status' => 'Проверяется', 'count' => '2', 'payment_status' => 'Ожидание'],
            ['user_id' => '3', 'type_id' => '2', 'status' => 'Оценено', 'count' => '1', 'price' => '50000', 'payment_status' => 'Ожидание'],
            ['user_id' => '4', 'type_id' => '3', 'status' => 'Выполняется', 'count' => '1', 'price' => '30000', 'payment_status' => 'Успешно'],
            ['user_id' => '5', 'type_id' => '4', 'status' => 'Завершено', 'count' => '2', 'price' => '60000', 'payment_status' => 'Успешно', 'completed_at' => '2026-02-10 14:10:12'],
            ['user_id' => '2', 'type_id' => '5', 'status' => 'Ошибка', 'count' => '3', 'payment_status' => 'Ожидание', 'failed_message' => 'Не подлежит восстановлению'],
            ['user_id' => '3', 'type_id' => '6', 'status' => 'Оценено', 'count' => '3', 'price' => '75000', 'payment_status' => 'Ошибка', 'failed_message' => 'Ошибка оплаты'],

            ['user_id' => '4', 'type_id' => '7', 'status' => 'Проверяется', 'count' => '2', 'payment_status' => 'Ожидание'],
            ['user_id' => '5', 'type_id' => '8', 'status' => 'Оценено', 'count' => '1', 'price' => '50000', 'payment_status' => 'Ожидание'],
            ['user_id' => '2', 'type_id' => '9', 'status' => 'Выполняется', 'count' => '1', 'price' => '30000', 'payment_status' => 'Успешно'],
            ['user_id' => '3', 'type_id' => '10', 'status' => 'Завершено', 'count' => '2', 'price' => '60000', 'payment_status' => 'Успешно', 'completed_at' => '2026-02-10 14:10:12'],
            ['user_id' => '4', 'type_id' => '11', 'status' => 'Ошибка', 'count' => '3', 'payment_status' => 'Ожидание', 'failed_message' => 'Не подлежит восстановлению'],

            ['user_id' => '5', 'type_id' => '12', 'status' => 'Проверяется', 'count' => '2', 'payment_status' => 'Ожидание'],
            ['user_id' => '2', 'type_id' => '13', 'status' => 'Оценено', 'count' => '1', 'price' => '50000', 'payment_status' => 'Ожидание'],
            ['user_id' => '3', 'type_id' => '14', 'status' => 'Выполняется', 'count' => '1', 'price' => '30000', 'payment_status' => 'Успешно'],
            ['user_id' => '4', 'type_id' => '15', 'status' => 'Завершено', 'count' => '2', 'price' => '60000', 'payment_status' => 'Успешно', 'completed_at' => '2026-02-10 14:10:12'],
            ['user_id' => '5', 'type_id' => '1', 'status' => 'Ошибка', 'count' => '3', 'payment_status' => 'Ожидание', 'failed_message' => 'Не подлежит восстановлению'],

            ['user_id' => '2', 'type_id' => '2', 'status' => 'Проверяется', 'count' => '2', 'payment_status' => 'Ожидание'],
            ['user_id' => '3', 'type_id' => '3', 'status' => 'Оценено', 'count' => '1', 'price' => '50000', 'payment_status' => 'Ожидание'],
            ['user_id' => '4', 'type_id' => '4', 'status' => 'Выполняется', 'count' => '1', 'price' => '30000', 'payment_status' => 'Успешно'],
            ['user_id' => '5', 'type_id' => '5', 'status' => 'Завершено', 'count' => '2', 'price' => '60000', 'payment_status' => 'Успешно', 'completed_at' => '2026-02-10 14:10:12'],
            ['user_id' => '3', 'type_id' => '6', 'status' => 'Ошибка', 'count' => '3', 'payment_status' => 'Ожидание', 'failed_message' => 'Не подлежит восстановлению']
        ];

        foreach ($orders as $order) {
            Order::factory()->create($order);
        }
    }
}
