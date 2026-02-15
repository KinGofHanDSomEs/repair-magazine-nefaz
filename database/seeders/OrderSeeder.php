<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            ['user_id' => '11', 'technic_id' => '1', 'status' => 'pending', 'count' => '2', 'payment_status' => 'pending'],
            ['user_id' => '2', 'technic_id' => '2', 'status' => 'reviewed', 'count' => '1', 'price' => '50000', 'payment_status' => 'pending'],
            ['user_id' => '3', 'technic_id' => '3', 'status' => 'running', 'count' => '1', 'price' => '30000', 'payment_status' => 'success'],
            ['user_id' => '4', 'technic_id' => '4', 'count' => '2', 'status' => 'completed', 'price' => '60000', 'payment_status' => 'success', 'completed_at' => '2026-02-10 14:10:12'],
            ['user_id' => '5', 'technic_id' => '5', 'status' => 'failed', 'count' => '3', 'payment_status' => 'pending', 'failed_message' => 'Слишком много техники'],
            ['user_id' => '6', 'technic_id' => '7', 'status' => 'reviewed', 'count' => '3', 'price' => '75000', 'payment_status' => 'failed', 'failed_message' => ''],

            ['user_id' => '6', 'technic_id' => '6', 'status' => 'pending', 'count' => '2', 'payment_status' => 'pending'],
            ['user_id' => '7', 'technic_id' => '7', 'status' => 'reviewed', 'count' => '1', 'price' => '50000', 'payment_status' => 'pending'],
            ['user_id' => '8', 'technic_id' => '8', 'status' => 'running', 'count' => '1', 'price' => '30000', 'payment_status' => 'success'],
            ['user_id' => '9', 'technic_id' => '9', 'status' => 'completed', 'count' => '2', 'price' => '60000', 'payment_status' => 'success', 'completed_at' => '2026-02-10 14:10:12'],
            ['user_id' => '10', 'technic_id' => '10', 'status' => 'failed', 'count' => '3', 'payment_status' => 'pending', 'failed_message' => 'Слишком много техники'],

            ['user_id' => '11', 'technic_id' => '11', 'status' => 'pending', 'count' => '2', 'payment_status' => 'pending'],
            ['user_id' => '10', 'technic_id' => '12', 'status' => 'reviewed', 'count' => '1', 'price' => '50000', 'payment_status' => 'pending'],
            ['user_id' => '9', 'technic_id' => '13', 'status' => 'running', 'count' => '1', 'price' => '30000', 'payment_status' => 'success'],
            ['user_id' => '8', 'technic_id' => '14', 'status' => 'completed', 'count' => '2', 'price' => '60000', 'payment_status' => 'success', 'completed_at' => '2026-02-10 14:10:12'],
            ['user_id' => '7', 'technic_id' => '15', 'status' => 'failed', 'count' => '3', 'payment_status' => 'pending', 'failed_message' => 'Слишком много техники'],

            ['user_id' => '6', 'technic_id' => '16', 'status' => 'pending', 'count' => '2', 'payment_status' => 'pending'],
            ['user_id' => '5', 'technic_id' => '17', 'status' => 'reviewed', 'count' => '1', 'price' => '50000', 'payment_status' => 'pending'],
            ['user_id' => '4', 'technic_id' => '18', 'status' => 'running', 'count' => '1', 'price' => '30000', 'payment_status' => 'success'],
            ['user_id' => '3', 'technic_id' => '19', 'status' => 'completed', 'count' => '2', 'price' => '60000', 'payment_status' => 'success', 'completed_at' => '2026-02-10 14:10:12'],
            ['user_id' => '2', 'technic_id' => '20', 'status' => 'failed', 'count' => '3', 'payment_status' => 'pending', 'failed_message' => 'Слишком много техники']
        ];

        foreach ($orders as $order) {
            Order::factory()->create($order);
        }
    }
}
