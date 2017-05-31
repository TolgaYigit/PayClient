<?php

use Illuminate\Database\Seeder;

class GatewaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gateways')->insert([
            [
                'name' => 'PayPal',
                'default_currency' => 'EUR',
                'exchange_rate' => 1.08,
                'status' => 1
            ],
            [
                'name' => 'PayU',
                'default_currency' => 'TRY',
                'exchange_rate' => 1.12,
                'status' => 1
            ],
            [
                'name' => 'PayTrek',
                'default_currency' => 'USD',
                'exchange_rate' => 1.10,
                'status' => 1
            ],
        ]);
    }
}
