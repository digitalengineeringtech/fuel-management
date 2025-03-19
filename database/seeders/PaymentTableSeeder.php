<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            [
                'name' => 'Cash',
            ],
            [
                'name' => 'CreditCard',
            ],
            [
                'name' => 'KPay',
            ],
            [
                'name' => 'CBPay',
            ],
            [
                'name' => 'AYAPay',
            ],
            [
                'name' => 'KBZ BANK',
            ],
            [
                'name' => 'CB BANK',
            ],
            [
                'name' => 'AYA BANK',
            ],
            [
                'name' => 'Visa',
            ]
        ];

        foreach($payments as $payment) {
            Payment::create($payment);
        }
    }
}
