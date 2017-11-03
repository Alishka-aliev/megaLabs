<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 02.11.17
 * Time: 1:21
 */

namespace app\models\agregator;

abstract class FactoryMethod
{
    const IMG = 'img';
    const SONG = 'Song';

    abstract protected function createObj(string $type,string $absoluteFileName);

    public function create(string $type,string $absoluteFileName)
    {
        $obj = $this->createObj($type,$absoluteFileName);
        return $obj;
    }
}