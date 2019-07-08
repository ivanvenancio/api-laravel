<?php

use Illuminate\Database\Seeder;

class SpecifiersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\Specifier::class,100)->create();
    }
}
