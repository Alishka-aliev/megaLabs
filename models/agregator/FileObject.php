<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 02.11.17
 * Time: 1:21
 */

namespace app\models\agregator;

abstract class FileObject
{
    private $_src; //Путь до картинки
    private $_trackID; //id необязательный.
    //по умолчанию. Если вдруг картинки не будет.
    protected $defaultSrc;
    // Список расширений файлов
    protected $extList;
    //Url
    protected $serviceUrl = "";

    //ID объекта
    // abstract public function setExt();

    /** Сразу- проверка на валидность адресса, если все нормально, то оставляем иначе заменим Дефолтным значением.
     * File constructor.
     * @param $src
     */
    public function __construct($src = null)
    {
        if ($src) {
            $http = HttpRequest::getInstance();
            $responce = $http->request($this->serviceUrl . $src);
            $this->_src = $http->isValid($responce->getStatusCode()) ? $this->serviceUrl . $src :  $this->defaultSrc;
        } else {
            $this->_src = $this->defaultSrc;
        }
    }

    /**
     * путь до картинки
     * @return String
     */
    public function getSrc()
    {
        return $this->_src;
    }

    /**
     * добавим ID
     * @param $trackID
     */
    public function setTrackId($trackID)
    {
        $this->_trackID = $trackID;
    }



}