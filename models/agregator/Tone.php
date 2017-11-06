<?php

namespace app\models\agregator;

use app\models\interfaces\ReaderInterface;

/**
 * Основной класс Tone.
 * Created by PhpStorm.
 * User: ali
 * Date: 05.11.17
 * Time: 1:41
 */
class Tone implements ReaderInterface
{
    private $_id;
    private $_renderData;
    private $_code;
    private $_name;
    private $_artist;
    private $_period;
    private $_price;
    private $_short_code;
    private $_file;
    private $_images;
    private $_contracts = [];
    private $_platforms = [];


    /** В конструкторе, запустим все сетеры.
     * Tone constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->_renderData = $data;
        foreach ($data as $key => $val) {
            if (!is_array($val)) {
                $key = str_replace('_','',$key);
                if (method_exists($this, "set{$key}")) {
                    call_user_func_array(array($this, "set{$key}"), array($val));
                }
            }
        }
        if (isset($data['contracts'])) {

            foreach ($data['contracts'] as $contract) {

                $this->addContracts($contract);
            }
        }
        if (isset($data['platforms'])) {
            foreach ($data['platforms'] as $platforms) {
                $this->addPlatforms($platforms);
            }
        }
    }

    /**
     * геттеры
     * @return mixed
     */
    public function getFile()
    {
        return $this->_file;
    }

    public function getImage()
    {
        return $this->_images;
    }

    public function getContracts()
    {
        return $this->_contracts;
    }

    public function getPlatforms()
    {
        return $this->_platforms;
    }

    public function getShortCode()
    {
        return $this->_short_code;
    }

    public function getPeriod()
    {
        return $this->_period;
    }

    public function getPrice()
    {
        return $this->_price;
    }

    public function getArtist()
    {
        return $this->_artist;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getCode()
    {
        return $this->_code;
    }

    public function getId()
    {
        return $this->_id;
    }

    /**
     * Сэттеры
     * @param $src
     * @return mixed
     * @internal param $data
     */
    public function setFile($src)
    {
        if (!$this->_file) {
            $this->_file = new Song($src);
        }
    }

    public function setImages($src)
    {
        if (!$this->_images) {
            $this->_images = new Img($src);
        }
    }

    public function setShortCode($shortCode)
    {
        $this->_short_code = $shortCode;
    }

    public function setPeriod($period)
    {
        $this->_period = $period;
    }

    public function setArtist($artist)
    {
        $this->_artist = $artist;
    }

    public function setName($name)
    {
        $this->_name = $name;
    }

    public function setPrice($price)
    {
        $this->_price = $price;
    }

    public function setCode($code)
    {
        $this->_code = $code;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @param $item
     */
    public function addContracts($item)
    {
        array_push($this->_contracts, new Contracts($item));
    }

    /**
     * @param $item
     */
    public function addPlatforms($item)
    {
        array_push($this->_platforms, new Platforms($item));
    }


    public function renderData(): string
    {
        return $this->_renderData;
    }
}