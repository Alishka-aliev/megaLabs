<?php
namespace app\models\agregator;
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 04.11.17
 * Time: 22:28
 */
class Contracts
{
    private $_id;
    private $_name;
    private $_master_share;
    private $_author_share;

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
    public function getId()
    {
        return $this->_id;
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
    public function getMasterShare()
    {
        return $this->_master_share;
    }

    /**
     * @return mixed
     */
    public function getAuthorShare()
    {
        return $this->_author_share;
    }

}