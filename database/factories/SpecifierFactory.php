<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Specifier;

$faker = \Faker\Factory::create('pt_BR');

$factory->define(Specifier::class, function () use($faker) {
    $caracteres = ['/','.','-','(',')',' '];
    return [
        'cpf' => str_replace($caracteres,"",$faker->cpf),
        'first_name' => $faker->firstName(null) ,
        'last_name'  => $faker->lastName,
        'profession'  => $faker->jobTitle,
        'date_birth'  => $faker->date($format = 'Y-m-d', $max = 'now'),
        'phone'  => str_replace($caracteres,"",$faker->phoneNumber),
        'zip_code' => str_replace($caracteres,"",$faker->postcode),
        'state'  => $faker->stateAbbr,
        'city'  => $faker->city
    ];
});
