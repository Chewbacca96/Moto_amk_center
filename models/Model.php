<?php
/**
 * Created by PhpStorm.
 * User: Chewbacca
 * Date: 21.03.2019
 * Time: 21:21
 */

namespace Moto_catalogs\models;

class Model
{
    const SITE = 'http://amk-center.ru/motozapchasti';

    public function getFromUrl($yearCode, $markCode, $capacityCode)
    {
        $html = file_get_html(self::SITE.'/?qs=1&cat=260&type=1&y%5B%5D='.$yearCode.'&fmark%5B%5D='.$markCode.'&c%5B%5D='.$capacityCode);
        $html = $html->find('select[id="filterModel"]', 0)->find('option');

        $i = 0;
        foreach ($html as $model) {
            $models[$i]['code']  = $model->value;
            $models[$i]['value'] = $model->innertext;

            $i++;
        }

        return $models;
    }
}