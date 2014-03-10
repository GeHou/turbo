<?php

define('app_dir', __DIR__ . '/..');
define('engine_dir', app_dir . '/engine');

require engine_dir . '/engine.php';
require __DIR__.'/../vendor/autoload.php';

engine::run();
