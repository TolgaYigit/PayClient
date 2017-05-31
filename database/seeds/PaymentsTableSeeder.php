<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            [
                'name' => 'John Doe',
                'email' => 'John@Doe.com',
                'transection_value' => 125,
                'base_value' => 125,
                'currency' => 'EUR',
                'gateway_id' => 1,
                'status' => 'completed',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
