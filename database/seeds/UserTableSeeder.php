<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->defaultUser();

        $faker = Faker\Factory::create();

        foreach (range(1, 20) as $index) {
            User::create([
                "name" => $faker->name,
                "email" => $faker->unique()->email,
                "password" => Hash::make("123456"),
            ]);
        };

    }

    public function defaultUser()
    {
        User::create([
            "name" => "Kawsar Ahmed",
            "email" => "admin@mail.com",
            "password" => Hash::make("Admin@100%"),
        ]);
    }
}
