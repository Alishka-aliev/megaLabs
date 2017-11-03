<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 02.11.17
 * Time: 1:21
 */

namespace app\models\agregator;

abstract class File
{
    private $_src; //Путь до картинки
    private $_trackID; //id необязательный.
    //по умолчанию. Если вдруг картинки не будет.
    protected $defaultSrc;
    // Список расширений файлов
    protected $extList;

    //ID объекта
     abstract public function setExt();
    /**
     * File constructor.
     * @param $src
     */
    public function __construct($src = null)
    {
        $this->_src = $src ?: $this->defaultSrc;
    }

    /**
     * путь до картинки
     * @return String
     */
    public function getSrc(): String
    {
        return $this->_src;
    }

    /**
     * @param $trackID
     */
    public function setTrackId($trackID)
    {
        $this->_trackID = $trackID;
        // TODO: Implement setTrackId() method.
    }

}