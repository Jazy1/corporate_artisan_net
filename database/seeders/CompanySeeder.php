<?php

namespace Database\Seeders;

use App\Models\BankAccounts;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class CompanySeeder extends Seeder
{

    /**
     * The Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker ;

    /**
     * Create a new seeder instance.
     *
     * @param  \Faker\Generator  $faker
     * @return void
     */
    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $company = Company::factory()->create([
                'name' => 'Company ' . $i,
                'email' => 'company' . $i . '@example.com',
                'img' => '/img/profile-pictures/default.svg',
                'password' => bcrypt('1234567890'),
                'address' => 'Address ' . $i,
            ]);

            // Create Bank Account for company
            BankAccounts::factory()->create([
                'user_type' => 'company',
                'user_id' => $company->id,
                'current_balance' => $this->faker->numberBetween(100, 1000), // You can set an initial balance here
            ]);
        }
    }
}
