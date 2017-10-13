<?php

use Faker\Generator as Faker;

$factory->define( \App\CustomizerField::class, function ( Faker $faker ) {
	$section = factory( \App\Section::class )->create();

	return [
		"label"      => $faker->unique()->word,
		"default"    => $faker->unique()->word,
		"section_id" => $section->id
	];
} );
