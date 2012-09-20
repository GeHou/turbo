<?php
function is_identifier($str) {
    return is_string($str) && preg_match('/^[a-z][0-9a-z]*(_[0-9a-z]+)*$/', $str);
}
class engine {
    const controller_key = 'c';
    const action_key = 'a';
    const default_controller = 'site';
    const default_action = 'index';
    public static function run() {
        config::load();
        $controller_name = visitor::g_str(self::controller_key);
        if (!is_identifier($controller_name)) {
            $controller_name = self::default_controller;
        }
        $action_name = visitor::g_str(self::action_key);
        if (!is_identifier($action_name)) {
            $action_name = self::default_action;
        }
        require app_dir . '/controller/' . $controller_name . '.php';
        controller::set_target($controller_name, $action_name);
        $controller = $controller_name . '_controller';
        $action = $action_name . '_action';
        $controller::$action();
    }
}
class config {
    public static function get($key) {
        return self::$configs[$key];
    }
    public static function load() {
        require app_dir . '/config.php';
        $custom_file = app_dir . '/custom.php';
        if (is_readable($custom_file)) {
            require $custom_file;
        }
        self::$configs = $configs;
    }
    protected static $configs = array();
}
class visitor {
    public static function g_int($key, $default_value = 0) {
        return isset($_GET[$key]) && is_numeric($_GET[$key]) ? (int)$_GET[$key] : $default_value;
    }
    public static function g_str($key, $default_value = '') {
        return isset($_GET[$key]) && is_string($_GET[$key]) ? $_GET[$key] : $default_value;
    }
    public static function p_int() {
        return isset($_POST[$key]) && is_numeric($_POST[$key]) ? (int)$_POST[$key] : $default_value;
    }
    public static function p_str() {
        return isset($_POST[$key]) && is_string($_POST[$key]) ? $_POST[$key] : $default_value;
    }
    public static function g() {
        return $_GET;
    }
    public static function p() {
        return $_POST;
    }
}
class controller {
    public static function set($name, $value) {
        self::$args[$name] = $value;
    }
    public static function show($tpl_file = '') {
        if ($tpl_file === '') {
            $tpl_file = self::$controller_name . '_' . self::$action_name . '.tpl';
        }
        extract(self::$args);
        require app_dir . '/template/' . $tpl_file;
    }
    public static function set_target($controller_name, $action_name) {
        self::$controller_name = $controller_name;
        self::$action_name = $action_name;
    }
    public static $controller_name = '';
    public static $action_name = '';
    protected static $args = array();
}
class checker {
    
}
class model {
    
}
class binder {
    
}
