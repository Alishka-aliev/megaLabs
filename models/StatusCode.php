<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 01.11.17
 * Time: 1:03
 */
namespace app\models;

class StatusCode {


//https://msdn.microsoft.com/en-us/library/system.net.httpstatuscode(v=vs.110).aspx
    public function status($typeCode) {
       switch ($typeCode) {
           case 200 : return true; break;
           case 302 : return true; break;
           default : return false; break;
       }
    }
}