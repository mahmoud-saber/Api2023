<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'about_us' => '',
            'counter1_name' => 'Subscriptions',
            'counter1_count' => '100',
            'counter2_name' => 'Cities Office',
            'counter2_count' => '50',
            'counter3_name' => 'Worker',
            'counter3_count' => '200',
            'counter4_name' => 'Happy Clients',
            'counter4_count' => '500',
        ]);
    }
}