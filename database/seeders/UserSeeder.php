<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  public function run()
  {
    User::create([
      'name' => 'basit',
      'email' => 'basit@test.com',
      'email_verified_at' => now(),
      'password' => Hash::make('password'),
    ]);

    User::factory(10)->create();
  }
}
