<?php

namespace Database\Seeders;

use App\Models\BankAccounts;
use App\Models\Company;
use App\Models\Freelancer;
use App\Models\Gig;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class FreelancerSeeder extends Seeder
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
            $freelancer = Freelancer::factory()->create([
                'name' => ' Freelancer ' . $i,
                'img' => "/img/profile-pictures/default.svg",
                'email' => 'freelancer' . $i . '@example.com',
                'about' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod explicabo rem suscipit, temporibus natus quam nemo minus molestiae at atque architecto dolorem officiis dolorum assumenda voluptatibus amet deserunt itaque optio beatae debitis rerum ab velit. Vitae ipsa dolorum hic libero deserunt? Alias amet voluptatibus commodi praesentium sequi officia quae, nulla ratione, omnis vitae voluptates culpa ullam expedita eveniet doloremque ab voluptatum maiores ea. Inventore, neque tempora minus repellendus atque optio vel totam quas! Eius dolor consequatur vitae commodi accusamus dolores totam id, est pariatur nemo molestias quidem cupiditate suscipit maxime rem odio eveniet. Maxime nisi fugit iste sequi vitae enim.",
                'password' => bcrypt('1234567890'),
            ]);

            // Create Bank Account for Freelancer
            BankAccounts::factory()->create([
                'user_type' => 'freelancer',
                'user_id' => $freelancer->id,
                'current_balance' => $this->faker->numberBetween(1, 200), // You can set an initial balance here
            ]);

            // Loop to create 5 gigs
            for ($j = 1; $j <= 5; $j++) {
                // Create a new gig
                $gig = Gig::create([
                    'freelancer_id' => $freelancer->id, // Replace with your desired freelancer_id
                    'title' => "Lorem ipsum dolor, sit amet consectetur adipisicing." . " Sample Gig $j",
                    'description' => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestias aspernatur incidunt soluta, officiis nobis necessitatibus doloremque iste excepturi eaque mollitia eius ipsa, nam placeat corporis recusandae qui dignissimos corrupti nesciunt aliquam molestiae praesentium, obcaecati est! Nesciunt amet eveniet asperiores, id ipsum iste. Recusandae, dolores praesentium sunt temporibus, iste doloremque quasi consequatur facere deleniti quas libero tempora corrupti ipsam esse, deserunt enim impedit at. Similique voluptatibus totam eligendi recusandae ea quos blanditiis illo rem quia molestiae! Ipsum perferendis id illo, voluptatem quia ipsam quaerat ipsa, nemo maxime distinctio amet dicta temporibus nisi! Dolorum aut nisi voluptatem laudantium impedit ullam tenetur alias?",
                    'category_id' => $j, // Replace with your desired category_id
                    'price' => rand(10, 500), // Replace with your desired price logic
                    'images' => [
                        "gig-images/default/0_I'll be your worker.png",
                        "gig-images/default/1_I'll be your worker.png",
                        "gig-images/default/2_I'll be your worker.png",
                        "gig-images/default/3_I'll be your worker.png",
                        "gig-images/default/4_I'll be your worker.png",
                    ],
                    'uuid' => Str::uuid(),
                    'status' => "active",
                ]);
            }

            for ($k = 1; $k <= 10; $k++) {
                $companies = Company::pluck('id')->toArray();
                $gigs = Gig::pluck('id')->toArray();
                Order::create([
                    'freelancer_id' => $freelancer->id,
                    'company_id' => $i,
                    'gig_id' => $this->getRandomElement($gigs),
                    'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, iure. Esse, aut placeat. Eius laboriosam amet doloremque tenetur beatae dolorum iure. Provident sapiente aliquam ullam ipsum tenetur obcaecati ut expedita repellendus eaque, hic tempora veniam aut error fugit officia minima!",
                    "number" => rand(10000000, 99999999),
                    'amount' => rand(100, 200), // Adjust the range as needed
                    'time' => rand(1, 4),
                    'status' => $this->getRandomElement(['completed', 'pending', 'cancelled']),
                ]);
            
            }

        }
    }

    private function getRandomElement(array $array)
    {
        return $array[array_rand($array)];
    }
}
