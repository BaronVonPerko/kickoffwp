<?php

class CustomMyPage
{
    private $wp_customize;

    public static function Register($wp_customize) {
        $customizer = new CustomMyPage();

        $customizer->wp_customize = $wp_customize;

        $customizer->SetupSection()->SetupSettings()->SetupControls();
    }

    private function SetupSection() {
        $this->wp_customize->add_section('PerkoTheme_MyPage', array(
            'title'     => 'My Page',
            'priority'  => 30,
        ) );

        return $this;
    }

    private function SetupSettings() {
        $this->wp_customize->add_setting('PerkoTheme_MyPage_test', array(
            'default' => 'test'
        ));

        $this->wp_customize->add_setting('PerkoTheme_MyPage_area', array(
            'default' => 'this is a text area'
        ));

        $this->wp_customize->add_setting('PerkoTheme_MyPage_AwesomeColor!', array(
            'default' => 'f00'
        ));

        $this->wp_customize->add_setting('PerkoTheme_MyPage_ImagePicker', array(
            'default' => ''
        ));

        $this->wp_customize->add_setting('PerkoTheme_MyPage_UploadControl', array(
            'default' => ''
        ));


        return $this;
    }

    private function SetupControls() {
        $this->wp_customize->add_control( new WP_Customize_Control( $this->wp_customize, 'PerkoTheme_MyPage_testControl', array(
            'label' => 'test',
            'section' => 'PerkoTheme_MyPage',
            'settings' => 'PerkoTheme_MyPage_test',
        ) ) );

        $this->wp_customize->add_control( new WP_Customize_Control( $this->wp_customize, 'PerkoTheme_MyPage_areaControl', array(
            'label' => 'area',
            'section' => 'PerkoTheme_MyPage',
            'settings' => 'PerkoTheme_MyPage_area',
            'type'  => 'textarea'
        ) ) );

        $this->wp_customize->add_control( new WP_Customize_Color_Control( $this->wp_customize, 'PerkoTheme_MyPage_AwesomeColor!Control', array(
            'label' => 'Awesome Color!',
            'section' => 'PerkoTheme_MyPage',
            'settings' => 'PerkoTheme_MyPage_AwesomeColor!',
        ) ) );

        $this->wp_customize->add_control( new WP_Customize_Image_Control( $this->wp_customize, 'PerkoTheme_MyPage_ImagePickerControl', array(
            'label' => 'Image Picker',
            'section' => 'PerkoTheme_MyPage',
            'settings' => 'PerkoTheme_MyPage_ImagePicker',
        ) ) );

        $this->wp_customize->add_control( new WP_Customize_Upload_Control( $this->wp_customize, 'PerkoTheme_MyPage_UploadControlControl', array(
            'label' => 'Upload Control',
            'section' => 'PerkoTheme_MyPage',
            'settings' => 'PerkoTheme_MyPage_UploadControl',
        ) ) );


        return $this;
    }
}