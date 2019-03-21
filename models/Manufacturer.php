<?php
/**
 * Created by PhpStorm.
 * User: Chewbacca
 * Date: 20.03.2019
 * Time: 22:54
 */

namespace Moto_catalogs\models;

class Manufacturer
{
    const SITE = 'http://amk-center.ru/motozapchasti';

    public function getFromUrl()
    {
        $html = file_get_html(self::SITE);
        $html = $html->find('select[data-placeholder="Выберите производителя"]', 0)->find('option');

        $i = 0;
        foreach ($html as $manufacturer) {
            $manufacturers[$i]['code']  = $manufacturer->value;
            $manufacturers[$i]['value'] = $manufacturer->innertext;

            $i++;
        }

        return $manufacturers;
    }
}