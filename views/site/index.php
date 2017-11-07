<?php

/* @var $this yii\web\View */

$this->title = 'MegaLabs test';
?>

<div class="site-index">
    <div class="container">
        <div class="jumbotron">
            <form method="get" id="frm">
                <div class="input-group searcher">
                    <input type="text" class="input__control input__input" value="<?=$get;?>" name="q" placeholder="Search ...">
                    <span id="searchclear" class="glyphicon glyphicon-remove-circle"></span>
                    <span class="input-group-btn">
                 <button class="btn btn-megafon" type="button" onclick="App.send();">Найти</button>
                </span>
                </div><!-- /input-group -->
            </form>
        </div>
        <div style="padding-right: 60px;padding-left: 60px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <!-- Single button -->
                        <a class="btn btn-sm btn-default" href="javascript:void(0);" onclick="App.excel.exports();">Экспорт</a>
                        <a class="btn btn-sm btn-default" href="javascript:void(0);" onclick="App.cart.add();">Добавить в корзину</a>
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
                            foreach ($toneList as $tone){
                            echo     Yii::$app->controller->renderPartial('//_template/tone.item.php', ['tone' => $tone]);
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 60px;">
                <div class="col-md-12">
                    <div class="pull-right">
                        <!-- Single button -->

                        <a class="btn btn-sm btn-default" href="javascript:void(0);" onclick="App.excel.exports();">Экспорт</a>
                        <a class="btn btn-sm btn-default" href="javascript:void(0);" onclick="App.cart.add();">Добавить в корзину</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$autocomplite = <<<AUTOCOMPLITE
new autoComplete({
    minChars:1,
    selector: 'input[name="q"]',
    source: function(term, response){
        $.getJSON('/site/search', { q: term }, function(choices){
          var suggestions = [];
                for (i=0;i<choices.length;i++)
                    if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                response(suggestions);
         });
    }
});
$('#searchclear').on('click',function(){
$('input[name="q"]').val('');
});
$(document).ajaxStart(function() { Pace.restart(); }); 
AUTOCOMPLITE;

$this->registerJs($autocomplite);
?>
<?php $this->registerJs("Table.init('.tbl-data');") ?>
