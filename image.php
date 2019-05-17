<?php
require_once('fooImageClass.php');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
$param = filter_input(INPUT_GET, 'param', FILTER_SANITIZE_STRING);

preg_match('/image\-([0-9]+)\-([0-9]+)(\-([0-9]+)){0,1}/', $param, $m);

//var_dump($m);
$width = key_exists(1, $m) ? $m[1] : 100;
$height = key_exists(2, $m) ? $m[2] : 100;
$type = key_exists(4, $m) ? $m[4] : 99;


$image = new FooImage($width, $height, $type);
$image->display();
