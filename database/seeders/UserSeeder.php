<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'firstname' => 'Amid',
            'lastname' => 'Esfahani',
            'firstname_fa' => 'عمید',
            'lastname_fa' => 'اصفهانی',
            'mobile' => '09171585814',
            'email' => 'amid.esfahani@yahoo.com',
            'birthdate' => Carbon::createFromFormat("Y-m-d", "1986-02-17"),
            'gender' => 'male',
            'admin' => 1,
            'super_admin' => 1,
            'mobile_verified_at' => Carbon::now()->toDateTimeString(),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'password' => '$2y$10$jCMMHn5kkC0Z78FPQgNLXe7IiNMXS/ke9BOtXlNIQK1zgQznqUfwW' // bwd
        ]);
    }
}
