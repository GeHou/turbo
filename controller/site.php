<?php
class site_controller extends controller {
    public static function index_action() {
        self::set('name', 'hello, world');
        self::show('a.tpl');
    }
    public static function hello_action() {
        self::set('name', config::get('site_title'));
        self::show('a.tpl');
    }
}
