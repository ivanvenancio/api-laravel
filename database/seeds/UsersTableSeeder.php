<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Ivan Venancio',
            'email' => 'ivan@nowsolutions.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make('123mudar'),
            'remember_token' => Str::random(10),
        ]);
        factory(\App\User::class,1)->create();
    }
}
