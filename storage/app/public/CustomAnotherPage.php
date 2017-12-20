<?php

class CustomAnotherPage
{
    private $wp_customize;

    public static function Register($wp_customize) {
        $customizer = new CustomAnotherPage();

        $customizer->wp_customize = $wp_customize;

        $customizer->SetupSection()->SetupSettings()->SetupControls();
    }

    private function SetupSection() {
        $this->wp_customize->add_section('PerkoTheme_AnotherPage', array(
            'title'     => 'Another Page',
            'priority'  => 30,
        ) );

        return $this;
    }

    private function SetupSettings() {
        $this->wp_customize->add_setting('PerkoTheme_AnotherPage_somecolor', array(
            'default' => ''
        ));


        return $this;
    }

    private function SetupControls() {
        $this->wp_customize->add_control( new WP_Customize_Color_Control( $this->wp_customize, 'PerkoTheme_AnotherPage_somecolorControl', array(
            'label' => 'some color',
            'section' => 'PerkoTheme_AnotherPage',
            'settings' => 'PerkoTheme_AnotherPage_somecolor',
        ) ) );


        return $this;
    }
}