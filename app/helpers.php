<?php
    /*
     * Helpers.php
     * Loaded using autoload -> composer.json
     */

    define("BASE_PATH", __DIR__.'/..') ;
    define("TWIG_PATH", __DIR__.'/../views');


    if(!function_exists('base_path')) {
        function base_path() {
            return __DIR__.'/..';
        }
    }