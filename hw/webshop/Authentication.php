<?php
class Authentication
{
    const ADMIN_USERNAME = 'root';
    const ADMIN_PASSWORD = 'toor';

    public static function adminPanelAuth() {
        if ((@$_SERVER['PHP_AUTH_USER'] !== self::ADMIN_USERNAME) || (@$_SERVER['PHP_AUTH_PW'] !== self::ADMIN_PASSWORD)) {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm = "WebShop Admin panel"');
            exit;
        }
    }
}