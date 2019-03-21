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

//$site = 'http://amk-center.ru/motozapchasti';
//$html = file_get_html($site);

$Year     = new Year();
$Mark     = new Mark();
$Capacity = new Capacity();
$Model    = new Model();

$file = fopen($config['fileName'], 'w');

$years = $Year->getFromUrl();
//var_dump($years);

foreach ($years as $year) {
    $marks = $Mark->getFromUrl($year['code']);
    //var_dump($marks);

    foreach ($marks as $mark) {
        $capacities = $Capacity->getFromUrl($year['code'], $mark['code']);

        foreach ($capacities as $capacity) {
            $models = $Model->getFromUrl($year['code'], $mark['code'], $capacity['code']);

            foreach ($models as $model) {
                //echo $year['value'].' '.$mark['value'].' '.$capacity['value'].' '.$model['value']."\n";
                fputcsv($file, [$year['value'], $mark['value'], $capacity['value'], $model['value']]);
            }
        }
    }
}

fclose($file);

/*$Manufacturer = new Manufacturer();
$manufacturers = $Manufacturer->getFromUrl();
var_dump($manufacturers);

$Category = new Category();
$categories = $Category->getFromUrl();
var_dump($categories);*/

//$Model->getFromUrl($Mark->getMarkUrl($marks[0]['value']));

//echo $html;
//var_dump($html);