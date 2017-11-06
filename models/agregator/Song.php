<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 03.11.17
 * Time: 0:24
 */

namespace app\models\agregator;
class Song extends FileObject
{
    protected $serviceUrl = "http://85.143.218.211:9093/";
    protected $defaultSrc = 'https://soundcloud.com/pascaljuniorofficial/pascal-junior-she-likes-it-original-mix';
    protected $extList = ['wav', 'mp3'];
}