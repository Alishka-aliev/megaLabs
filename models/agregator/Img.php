<?php
/**
 * Обект картинка
 * Created by PhpStorm.
 * User: ali
 * Date: 02.11.17
 * Time: 0:53
 */

namespace app\models\agregator;


class Img extends FileObject
{
    protected $extList=['png','jpeg','jpg'];
    protected $defaultSrc = 'http://via.placeholder.com/200x200';
    protected $serviceUrl = "http://85.143.218.211:9092";

}