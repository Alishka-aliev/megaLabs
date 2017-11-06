<?php
namespace app\models\agregator;
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 05.11.17
 * Time: 1:31
 */
class Platforms
{
    private $_name;
    private $_period;

    public function __construct($data)
    {
        foreach ($data as $key => $val) {
            $key="_".$key;
            if (property_exists($this, $key)) {
                $this->{$key} = $val;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->_period;
    }

}