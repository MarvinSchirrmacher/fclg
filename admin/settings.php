<?php
function fco_initialize_settings() {
    register_setting(
        FcOnlineSettings::$page,
        FcOnlineSettings::$optionLoginRedirectUrl
    );
    add_settings_section(
        FcOnlineSettings::$section,
        __('FC Online', THEME_TEXTDOMAIN),
        'FcOnlineSettings::echoSectionHeader',
        FcOnlineSettings::$page
    );
    add_settings_field(
        'fco_login_redirect_url',
        __('Loging redirect url', THEME_TEXTDOMAIN),
        'FcOnlineSettings::echoLoginRedirectUrlField',
        FcOnlineSettings::$page,
        FcOnlineSettings::$section
    );
}
add_action('admin_init', 'fco_initialize_settings');

class FcOnlineSettings
{
    public static $page = 'general';
    public static $section = 'fco_settings_section';
    public static $optionLoginRedirectUrl = 'fco_login_redirect_url';

    public static function echoSectionHeader() {
        echo '';
    }

    public static function echoLoginRedirectUrlField() {
        $option = get_option( self::$optionLoginRedirectUrl );
        echo sprintf(
            '<input type="text" name="%s" id="login-redirect-url" class="regular-text" value="%s" />',
            self::$optionLoginRedirectUrl,
            ( isset( $option ) ? esc_attr( $option ) : '' )
        );
    }
}
?>
