<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Office;

$faker = \Faker\Factory::create('pt_BR');

$factory->define(Office::class, function () use($faker) {
    $caracteres = ['/','.','-'];
    return [
        'cnpj' => str_replace($caracteres,"",$faker->cnpj),
        'fantasy_name' => $faker->company,
        'social_name'  => $faker->companySuffix,
        'zip_code' => str_replace($caracteres,"",$faker->postcode)
    ];
});
