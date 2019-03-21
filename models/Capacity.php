<?php
/**
 * Created by PhpStorm.
 * User: Chewbacca
 * Date: 21.03.2019
 * Time: 22:56
 */

namespace Moto_catalogs\models;

class Capacity
{
    const SITE = 'http://amk-center.ru/motozapchasti';

    public function getFromUrl($yearCode, $markCode)
    {
        $html = file_get_html(self::SITE.'/?qs=1&cat=260&type=1&y%5B%5D='.$yearCode.'&fmark%5B%5D='.$markCode);
        $html = $html->find('select[id="filterCapacity"]', 0)->find('option');

        $i = 0;
        foreach ($html as $capacity) {
            $capacities[$i]['code']  = $capacity->value;
            $capacities[$i]['value'] = $capacity->innertext;

            $i++;
        }

        return $capacities;
    }
}