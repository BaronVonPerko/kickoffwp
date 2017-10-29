<?php

use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::first();
		$theme = factory(\App\Theme::class)->create(['user_id' => $user->id]);
		$section = factory(\App\Section::class)->create(['theme_id' => $theme->id]);
    }
}
