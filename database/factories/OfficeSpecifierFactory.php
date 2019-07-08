<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\OfficeSpecifier;
use Faker\Generator as Faker;

$factory->define(OfficeSpecifier::class, function (Faker $faker) {
    return [
        'specifier_id' => rand(1,100),
        'office_id' => rand(1,100)
    ];
});
