<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SeedUsers extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'asdasdasd',
            'surname' => 'asdasdasd',
            'patronymic' => 'asdasdasd',
            'email' => 'asd@asd.asd',
            'login' => 'asdasdasd',
            'password' => Hash::make('asdasdasd'),
            'is_admin' => 0,
        ]);

        \App\Models\User::factory()->create([
          'name' => 'zxczxczxc',
          'surname' => 'zxczxczxc',
          'patronymic' => 'zxczxczxc',
          'email' => 'zxc@zxc.zxc',
          'login' => 'zxczxczxc',
          'password' => Hash::make('zxczxczxc'),
          'is_admin' => 1,
      ]);
    }
}
