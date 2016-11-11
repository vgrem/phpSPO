<?php

spl_autoload_register(function ($class) {
    $prefix = 'Office365\\PHP\\Client\\';
    $base_dir =  __DIR__;
    $file = $base_dir . str_replace($prefix, "\\", $class) . ".php";
    if (file_exists($file)) {
        require $file;
    }
});

