<?php

if(!defined('_THEME_PATH_')){
    define('_THEME_PATH_',_FILE_PATH_.'template/');
}



require_once _THEME_PATH_.'functions.php';

require_once __DIR__.'/core/page.php';
require_once __DIR__.'/core/Parsedown.php';
require_once __DIR__.'/core/Spyc.php';
require_once __DIR__.'/core/mediator.php';