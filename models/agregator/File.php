<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 02.11.17
 * Time: 1:21
 */
namespace app\models\agregator;

abstract class File {
    private $_src; //Путь до картинки

    //ID объекта
    abstract public function setExt;
    /**
     * File constructor.
     * @param $src
     */
    public function __construct($src)
    {
        $this->_src = $src;
    }
    /**
     * путь до картинки
     * @return String
     */
    public function getSrc(): String
    {
        return $this->_src;
    }
}