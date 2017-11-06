<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 05.11.17
 * Time: 21:43
 */
namespace app\models\agregator;

use yii\httpclient\Client;

class HttpRequest {

    private $_client;
    /**
     * @var Singleton
     */
    private static $instance;


    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {
        $this->_client = new Client();
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    private function __wakeup()
    {
    }

    public  function request($url,$method='get',$format=Client::FORMAT_JSON){
         $response = $this->_client->createRequest()
            ->setMethod($method)
            ->addHeaders(['content-type' => 'application/json'])
            ->setFormat($format)
            ->setUrl($url)
            ->send();
           return $response;
    }

    public function isValid($statusCode)
    {
        switch ($statusCode) {
            case 200 :
                return true;
            case 404:
                return false;
            // e.t.c
            default:
                return false;
        }
    }
}