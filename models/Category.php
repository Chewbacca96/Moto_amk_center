<?php
/**
 * Created by PhpStorm.
 * User: Chewbacca
 * Date: 20.03.2019
 * Time: 22:58
 */

namespace Moto_catalogs\models;

class Category
{
    const SITE = 'http://amk-center.ru/motozapchasti';

    public function getFromUrl()
    {
        $html = file_get_html(self::SITE);
        $html = $html->find('ul', 13)->find('a');

        $i = 0;
        foreach ($html as $category) {
            $categories[$i]['value'] = $category->innertext;

            $i++;
        }

        return $categories;
    }
}