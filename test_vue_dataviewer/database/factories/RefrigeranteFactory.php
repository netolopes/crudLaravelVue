<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */


use App\Refrigerante;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Refrigerante::class, function (Faker $faker) {
    return [
    'marca' => $faker->word,                                             
    'tipo' => $faker->randomLetter,
    'sabor' =>  $faker->word,
    'litragem' =>  $faker->numberBetween($min = 1000, $max = 9000),
    'valor_unidade' => $faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 1000.00),
    'quantidade' =>  $faker->randomDigitNotNull,
];
});
