<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $genders = ['male', 'female', 'others'];
        $statuses = ['active', 'inactive'];

        for ($i = 1; $i <= 20; $i++) {

            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->numerify('##########'),
                'gender' => $faker->randomElement($genders),
                'status' => $faker->randomElement($statuses),
                'password' => Hash::make('123456'),
            ]);

            // Assign Roles
            if ($i <= 5) {
                $user->assignRole('admin');
            } elseif ($i <= 12) {
                $user->assignRole('teacher');
            } else {
                $user->assignRole('student');
            }
        }
    }
}
