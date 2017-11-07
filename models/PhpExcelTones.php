<?php

namespace app\models;

use Yii;
use app\models\ToneCollection;

/**
 * Created by PhpStorm.
 * User: ali
 * Date: 07.11.17
 * Time: 0:14
 */
class  PhpExcelTones
{
    protected $_data;

    public function __construct($data)
    {
        $this->_data = $data;
    }

    /** Получение данных для форматирования excel. Что бы показать header.
     * @return array
     */
    public function getHeaderTitle()
    {
        return [
            'number' => array('name' => '№', 'column' => 'A', 'width' => 10),
            'name' => array('name' => 'Наименование', 'column' => 'B', 'width' => 40),
            'img' => array('name' => 'Картинка', 'column' => 'C', 'width' => 40),
            'code' => array('name' => 'Код трека', 'column' => 'D', 'width' => 30),
            'period' => array('name' => 'Период', 'column' => 'E', 'width' => 20),
            'artist' => array('name' => 'Исполнитель', 'column' => 'F', 'width' => 20),
            'price' => array('name' => 'Цена', 'column' => 'G', 'width' => 15),
            'shortCode' => array('name' => 'Короткий код', 'column' => 'H', 'width' => 15),
            'contract' => array('name' => 'Контракты', 'column' => 'I', 'width' => 70),
            'platforms' => array('name' => 'Платформы', 'column' => 'K', 'width' => 70),
        ];
    }

    public function export()
    {
        error_reporting(0);
        // Создаем объект класса PHPExcel
        $xls = new \PHPExcel();
// Устанавливаем индекс активного листа
        $xls->setActiveSheetIndex(0);
// Получаем активный лист
        $sheet = $xls->getActiveSheet();
// Подписываем лист
        $sheet->setTitle('Список аудио');

// Выравнивание текста
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(
            \PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $data = Yii::$app->request->get('data');
        $collection = new ToneCollection($data);
        $toneList = $collection->getToneData();
        $head = $this->getHeaderTitle();
        foreach ($head as $key => $val) {
            $sheet->setCellValue($val['column'] . "1", $val['name']);
            $sheet->getColumnDimension($val['column'])->setWidth($val['width']);
            $sheet->getRowDimension(1)->setRowHeight(20);
        }
        $j = 2;
        if ($toneList) {
            for ($i = 2; $i <= (count($toneList) + 1); $i++) {
                $sheet->getRowDimension($j)->setRowHeight(70);
                $sheet->setCellValue($head['number']['column'] .$j, ($i - 1));
                // Выводим Наименование
                $sheet->setCellValue($head['name']['column'] . $j,  $toneList[$i - 2] ->getName());
                // Выводим Код трека
                $sheet->setCellValue($head['code']['column'] . $j, $toneList[$i - 2]->getCode());

                // Выводим Исполнитель
                $sheet->setCellValue($head['artist']['column'] . $j, $toneList[$i - 2]->getArtist());

                // Выводим Период
                $sheet->setCellValue($head['period']['column'] . $j, $toneList[$i - 2]->getPeriod());

                // Выводим Цена
                $sheet->setCellValue($head['price']['column'] . $j, $toneList[$i - 2]->getPrice());

                // Выводим Короткий код
                $sheet->setCellValue($head['shortCode']['column'] . $j, $toneList[$i - 2]->getShortCode());

                //Вставка картинки
                $objDrawing = new \PHPExcel_Worksheet_MemoryDrawing();
                if ($toneList[$i - 2]->getImage()) {
                    // imagecreatefromXXX  (XXX is jpeg png or gif)
                    $gdImage = imagecreatefromjpeg($toneList[$i - 2]->getImage()->getSrc());
                    $objDrawing->setImageResource($gdImage);
                    $objDrawing->setRenderingFunction(\PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
                    $objDrawing->setMimeType(\PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);

                }
                $objDrawing->setHeight(70);
                $objDrawing->setCoordinates($head['img']['column'] . $j );
                $objDrawing->setWorksheet($sheet);

                // Контракты
                $contracts = $toneList[$i - 2]->getContracts();
                $txt="";
                foreach ($contracts as $contract) {
                    $txt.= $contract->getName()." (".$contract->getMasterShare()."-".$contract->getAuthorShare().")\r\n";
                }
                $sheet->setCellValue($head['contract']['column'] . $j, $txt);
                // Платформа
                $platforms = $toneList[$i - 2]->getPlatforms();
                $txt="";
                foreach ($platforms as $platform) {
                    $txt.=$platform->getName()." (".$platform->getPeriod().")\r\n";
                }
                $sheet->setCellValue($head['platforms']['column'] . $j, $txt);
                $j++;
            }
        }

        // Выводим содержимое файла
        $objWriter = new \PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');


    }
}