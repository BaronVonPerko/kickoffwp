<?php

use Faker\Generator as Faker;

$factory->define( \App\CustomizerClass::class, function ( Faker $faker ) {
	return [
		'theme_name'   => $faker->word,
		'section_name' => $faker->word
	];
} );
