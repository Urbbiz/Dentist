<?php

session_start();

define('INSTALL_DIR', '/home/internalandriusurbonas/php/visma-pirmas/');
define('DIR', __DIR__ . '/');   //constants case sensitive


spl_autoload_register(
    function ($class) {
        $rootDir = __DIR__;
        $sourceDir = '//';

        $file = $rootDir.$sourceDir.str_replace('\\', '/', $class).'.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
);

