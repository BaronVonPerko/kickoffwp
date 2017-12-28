<?php

class Customnewsection
{
    private $wp_customize;

    public static function Register($wp_customize) {
        $customizer = new Customnewsection();

        $customizer->wp_customize = $wp_customize;

        $customizer->SetupSection()->SetupSettings()->SetupControls();
    }

    private function SetupSection() {
        $this->wp_customize->add_section('KickoffStarterTheme_newsection', array(
            'title'     => 'new section',
            'priority'  => 30,
        ) );

        return $this;
    }

    private function SetupSettings() {

        return $this;
    }

    private function SetupControls() {

        return $this;
    }
}