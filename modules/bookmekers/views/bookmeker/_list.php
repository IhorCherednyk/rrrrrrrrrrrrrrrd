<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="book-list tbl">
    <div class="book-left-wrapper dc">
        <?php echo Html::img($model->img_medium, ['alt' => $model->name]); ?>
    </div>
    <span class="book-bonus dc">Bonus: <?= $model->bonus ?>$</span>
    <div class="book-right-wrapper dc">
        <?php echo Html::a('Обзор', ['/bookmekers/bookmeker/book-single', 'id' => $model->id], ['class' => 'btn btn-watch']);?>
        <?php echo Html::a('Регистрация', [$model->bonus_link], ['class' => 'btn btn-reg']);?>
    </div>
</div>