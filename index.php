<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__.'/init.php');
require_once(__DIR__.'/default-init.php');

$path = $_SERVER['REQUEST_URI'];
if($path!=_URL_PATH_){
    $path = str_replace(_URL_PATH_,'',$path); # another fine and dodgy hack
    $path = str_replace('///','/',$path); # another fine and dodgy hack

    $noq = explode('?',$path);
    $noq = explode('#',$noq[0]);
    $path = $noq[0];
}else{
    $path='';
}
if($path=='/'){
    $path = 'home';
}

$useMD = false;
$filename = '';

if(is_dir(_FILE_PATH_.$path)){
    $path = $path . 'index';
}
if(file_exists(_FILE_PATH_.$path.'.php')){
    
    $filename = $path.'.php';
    
}elseif(file_exists(_FILE_PATH_.$path.'.md')){
    
    $useMD = true;
    $filename = $path.'.md';
    
}else{
    header("HTTP/1.0 404 Not Found");
    echo "404: '{$path}' not found";
    die();
}
if(!isset($PAGE)){
    $PAGE = new page($filename,$useMD);
}else{
    $PAGE->file = $filename;
    $PAGE->useMD($useMD);
}
$PAGE->mediator->event('init');
if(file_exists(__DIR__.'/plugins/init.php')){
    require_once __DIR__.'/plugins/init.php';
}else{
    $PAGE->debug = true;
    $PAGE->debug_msg('index','no plugin dir - '.__DIR__.'/plugins/init.php');
}
$PAGE->mediator->event('plugin_init');
$PAGE->makepage();
