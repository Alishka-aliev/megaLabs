<?php

/* @var $this yii\web\View */

$this->title = 'Корзина';
?>

<div class="site-index">
    <div class="container">

        <div class="jumbotron">
            <h3 class="text-left">Корзина</h3>
        </div>
        <div style="padding-right: 60px;padding-left: 60px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <!-- Single button -->
                        <a class="btn btn-sm btn-default" href="javascript:void(0);" onclick="App.cart.remove();">Удалить с корзины</a>
                     </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12  col-sm-12">
                    <div class="body-content">
                        <table class="table  table-hover tbl-data">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="chckAll"></th>
                                <th style="width: 10%;">Картинка</th>
                                <th>информация</th>
                                <th>Контракты</th>
                                <th>Платформы</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($toneList as $tone) {
                                echo Yii::$app->controller->renderPartial('//_template/tone.item.php', ['tone' => $tone]);
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->registerJs("Table.init('.tbl-data');") ?>
