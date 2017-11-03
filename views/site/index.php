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
                    <table class="table table-responsive table-hover tbl-data">
                        <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Картинка</th>
                            <th>Код трека</th>
                            <th>Исполнитель</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Период</th>
                            <th>Короткий код</th>
                            <th>Контракты</th>
                            <th>Платформы</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                        </tr>

                        </tbody>
                    </table>
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

        </div>
    </div>
</div>



<?php
$autocomplite =<<<AUTOCOMPLITE
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
<?php $this->registerJs("Table.init('.tbl-data');")?>
