<?php

use Illuminate\Database\Seeder;

class OfficeSpecifiersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\OfficeSpecifier::class,10)->create();
    }
}
