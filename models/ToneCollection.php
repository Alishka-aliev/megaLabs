<?php

namespace app\models;
use app\models\agregator\HttpRequest;
use app\models\agregator\Tone;
use yii\base\InvalidParamException;

/**
 * Коллекция песен.
 * Created by PhpStorm.
 * User: ali
 * Date: 06.11.17
 * Time: 20:10
 */
class ToneCollection
{
    protected $_data;
    protected $_request;
    public function __construct($data)
    {
        $this->_request= HttpRequest::getInstance();
        $this->_data=$data;
    }

    /**
     *  получение коллекции Tones
     * @return array
     */
    public function getToneData() {

        $toneList=[];
        foreach ($this->_data as $k => $v) {
            $url = 'http://85.143.218.211:9091/tone/'.$v.'.json';
            $respItem = $this->_request->request($url);
          //   в сулчае неправильных данных, будет - exception при парсинге.
            try {
                $tmpData = $respItem->getData();
            } catch (InvalidParamException $e) {
                // Тут обработать ошибки - неправильный парсинг
                $tmpData=false;

            } catch (\Exception $e) {
                // Тут обработать ошибки - общие
                $tmpData=false;
            }
            // проверка на валидность.
            if ($this->_request->isValid($respItem->getStatusCode()) && $tmpData) {
                $toneList[] = new Tone($tmpData);
            }
        }
        return $toneList;
    }
}