<?php
/**
 * Created by PhpStorm.
 * User: Chewbacca
 * Date: 20.03.2019
 * Time: 22:28
 */

namespace Moto_catalogs\models;

class Year
{
    const SITE = 'http://amk-center.ru/motozapchasti';

    public function getFromUrl()
    {
        $html = file_get_html(self::SITE);
        $html = $html->find('select[id="filterYear"]', 0)->find('option');

        $i = 0;
        foreach ($html as $year) {
            $years[$i]['id']  = $year->value;
            $years[$i]['name'] = $year->innertext;

            $i++;
        }

        return $years;
    }
}