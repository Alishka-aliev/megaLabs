<?php

/* @var $this yii\web\View */

$this->title = 'MegaLabs test task';
?>


<div class="site-index">
    <div class="container">
        <div class="jumbotron">
            <div class="input-group searcher">
                <input type="text" class="input__control input__input" name="q" placeholder="Search ...">
                <span id="searchclear" class="glyphicon glyphicon-remove-circle"></span>
                <span class="input-group-btn">
                 <button class="btn btn-megafon" type="button">Найти</button>
                </span>
            </div><!-- /input-group -->


        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm  btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Экспорт данных <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">excel</a></li>
                            <li><a href="#">cvs</a></li>
                            <li><a href="#">txt</a></li>

                        </ul>
                    </div>
                    <a class="btn btn-sm btn-default" href="javascript:void(0);">Добавить в корзину</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm  btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Экспорт данных <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">excel</a></li>
                            <li><a href="#">cvs</a></li>
                            <li><a href="#">txt</a></li>

                        </ul>
                    </div>
                    <a class="btn btn-sm btn-default" href="javascript:void(0);">Добавить в корзину</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10  col-sm-12 col-md-offset-1">
            <div class="body-content">
                <table class="table  table-hover tbl-data">
                    <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Картинка</th>
                        <th>Период</th>
                        <th>Контракты</th>
                        <th>Платформы</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="midle"><input type="checkbox"></td>
                        <td class="midle"><img src="<?= \app\models\agregator\Img::DEFAULT_SRC ?>"></td>
                        <td>
                            <p>Код трека:1</p>
                            <p>Исполнитель:1</p>
                            <p>Название:1</p>
                            <p>Цена:1</p>
                            <p>Короткий код:1</p>
                        </td>
                        <td>4</td>
                        <td>5</td>
                         

                    </tr>

                    </tbody>
                </table>
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
AUTOCOMPLITE;

$this->registerJs($autocomplite);
?>
<?php $this->registerJs("Table.init('.tbl-data');") ?>
