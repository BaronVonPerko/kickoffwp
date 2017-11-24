<?php

use Faker\Generator as Faker;

$factory->define( \App\Section::class, function ( Faker $faker ) {
	$theme = factory( \App\Theme::class )->create();

	return [
		"name"     => $faker->unique()->word,
		"theme_id" => $theme->id
	];
} );
