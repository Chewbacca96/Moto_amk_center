<?php
/**
 * Created by PhpStorm.
 * User: Chewbacca
 * Date: 14.03.2019
 * Time: 21:14
 */

namespace Moto_catalogs;

//use Monolog\Logger;
//use Monolog\Handler\SyslogHandler;
use Moto_catalogs\models\Year;
use Moto_catalogs\models\Mark;
use Moto_catalogs\models\Capacity;
use Moto_catalogs\models\Model;
//use Moto_catalogs\models\Manufacturer;
//use Moto_catalogs\models\Category;

require 'vendor/autoload.php';
$config = require (isset($argv[1])) ? $argv[1] : 'config.php';

ini_set('log_errors', 'On');
//ini_set('error_log', $config['error_log']);
ini_set('max_execution_time', 0);
date_default_timezone_set('Europe/Moscow');

$Year     = new Year();
$Mark     = new Mark();
$Capacity = new Capacity();
$Model    = new Model();

$file = fopen($config['fileName'], 'w');

$years = $Year->getFromUrl();
//var_dump($years);

foreach ($years as $year) {
    $marks = $Mark->getFromUrl($year['id']);
    //var_dump($marks[0]['name']);

    foreach ($marks as $mark) {
        $capacities = $Capacity->getFromUrl($year['id'], $mark['id']);
        //var_dump($capacities[0]['name']);

        foreach ($capacities as $capacity) {
            $models = $Model->getFromUrl($year['id'], $mark['id'], $capacity['id']);

            foreach ($models as $model) {
                echo $year['name'].' '.$mark['name'].' '.$capacity['name'].' '.$model['name']."\n";
                fputcsv($file, [$year['name'], $mark['name'], $capacity['name'], $model['name']]);
            }
        }
    }
}

fclose($file);