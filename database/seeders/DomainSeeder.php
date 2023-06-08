<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Domain::updateOrCreate(['name' => 'مبدعون وافراد'], [
            'name' => 'مبدعون وافراد',
            'status' => '0',
        ]);
    }
    }