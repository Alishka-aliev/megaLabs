<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 02.11.17
 * Time: 1:21
 */

namespace app\models\agregator;

class FileFactory extends FactoryMethod
{
    //Фабрика файлов.
    /**
     * @param string $type
     * @param string $absoluteFileName
     * @return Img|Song
     */
    protected function createObj(string $type, string $absoluteFileName)
    {
        switch ($type) {
            case parent::IMG :
                return new Img($absoluteFileName);
            case parent::SONG :
                return new Song($absoluteFileName);
            default: new \InvalidArgumentException("$type  не валидный");
        }
    }

}