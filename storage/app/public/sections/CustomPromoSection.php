<?php

class CustomPromoSection
{
    private $wp_customize;

    public static function Register($wp_customize) {
        $customizer = new CustomPromoSection();

        $customizer->wp_customize = $wp_customize;

        $customizer->SetupSection()->SetupSettings()->SetupControls();
    }

    private function SetupSection() {
        $this->wp_customize->add_section('KickoffStarterTheme_PromoSection', array(
            'title'     => 'Promo Section',
            'priority'  => 30,
        ) );

        return $this;
    }

    private function SetupSettings() {
        $this->wp_customize->add_setting('KickoffStarterTheme_PromoSection_test', array(
            'default' => ''
        ));


        return $this;
    }

    private function SetupControls() {
        $this->wp_customize->add_control( new WP_Customize_Control( $this->wp_customize, 'KickoffStarterTheme_PromoSection_testControl', array(
            'label' => 'test',
            'section' => 'KickoffStarterTheme_PromoSection',
            'settings' => 'KickoffStarterTheme_PromoSection_test',
        ) ) );


        return $this;
    }
}