<?php
require "vendor/autoload.php";

use Phpcurd\CURD;

$curd = new CURD;

echo '<pre>'; print_r($curd->select('test')->whereIn('name', ['test', 'tt'])->first()); die;
