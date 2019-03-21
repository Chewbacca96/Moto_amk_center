<?php
/**
 * Created by PhpStorm.
 * User: Chewbacca
 * Date: 20.03.2019
 * Time: 22:44
 */

namespace Moto_catalogs\models;

class Mark
{
    const SITE = 'http://amk-center.ru/motozapchasti';

    public function getFromUrl($yearCode)
    {
        $html = file_get_html(self::SITE.'/?qs=1&cat=260&type=1&y%5B%5D='.$yearCode);
        $html = $html->find('select[id="filterMark"]', 0)->find('option');

        $i = 0;
        foreach ($html as $mark) {
            $marks[$i]['code']  = $mark->value;
            $marks[$i]['value'] = $mark->innertext;

            $i++;
        }

        return $marks;
    }
}