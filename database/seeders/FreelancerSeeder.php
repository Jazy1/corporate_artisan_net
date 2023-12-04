<?php

namespace Database\Seeders;

use App\Models\Freelancer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FreelancerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Freelancer::create([
            'name' => 'Freelancer',
            'email' => 'freelancer@example.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
