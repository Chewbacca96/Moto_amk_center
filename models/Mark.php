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
    const SITE = 'http://amk-center.ru/ajax/getfilteroptions';

    public function postRequest($yearID)
    {
        $postData = http_build_query([
            'qs'   => '1',
            'cat'  => '260',
            'type' => '1',
            'y[]'  => $yearID
        ]);

        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'X-Requested-With: XMLHttpRequest'."\r\n".
                             'Content-Type: application/x-www-form-urlencoded',
                'content' => $postData
            ]
        ];

        $context = stream_context_create($options);

        $response = file_get_contents(self::SITE, false, $context);
        return json_decode($response, true);
    }

    public function getFromUrl($yearID)
    {
        $response = self::postRequest($yearID);

        return $response['marks'];
    }
}