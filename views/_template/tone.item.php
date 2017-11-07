<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 05.11.17
 * Time: 23:03
 */
/* @var $tone \app\models\agregator\Tone */
use \yii\bootstrap\Html;

?>
<?php if (isset($tone) && (!empty($tone))): ?>
    <tr data-id="<?=$tone->getId();?>">
        <td class="midle chkbx"><input type="checkbox"></td>
        <td class="midle"><?php
            if ($tone->getImage()->getSrc()) {
                echo Html::a(Html::img($tone->getImage()->getSrc()));
            }
            ?>
            <p>
                <?php
                if ($tone->getFile()) {
                    echo Html::a("<i class=\"glyphicon glyphicon-play\"></i>&nbsp;&nbsp;", 'javascript:void(0)', ["onclick" => 'App.sound.play(\'' . $tone->getFile()->getSrc() . '\');']);
                    echo Html::a("<i class=\"glyphicon glyphicon-pause\"></i>&nbsp;&nbsp;", 'javascript:void(0)', ["onclick" => 'App.sound.pause(\'' . $tone->getFile()->getSrc() . '\');']);
                    }
                ?>
            </p>
        </td>
        <td class="midle-left">
            <p class="title">Код трека: <span class="values"><?= $tone->getCode() ?></span></p>
            <p class="title">Исполнитель: <span class="values"><?= $tone->getArtist() ?></span></p>
            <p class="title">Название: <span class="values"><?= $tone->getName() ?></span></p>
            <p class="title">Цена: <span class="values"><?= $tone->getPrice() ?></span></p>
            <p class="title">Период: <span class="values"><?= $tone->getPeriod() ?></span></p>
            <p class="title">Короткий код: <span class="values"><?= $tone->getShortCode() ?></span></p>
        </td>
        <td class="midle-left">
            <div>
                <?php foreach ($tone->getContracts() as $key => $contract): ?>
                    <p><span class="label label-info"><?php echo $contract->getName(); ?></span>&nbsp;<span
                                class="label label-success"><?= $contract->getMasterShare(); ?></span>
                        &nbsp;&nbsp;<span class="label label-success"><?= $contract->getAuthorShare(); ?></span></p>
                <?php endforeach; ?>
            </div>
        </td>
        <td class="midle-left">
            <?php foreach ($tone->getPlatforms() as $key => $platform): ?>
                <p><b><?= $platform->getName(); ?></b> <span
                            class="label label-success"><?= $platform->getPeriod(); ?></span></p>
            <?php endforeach; ?>


        </td>
    </tr>
<?php endif; ?>