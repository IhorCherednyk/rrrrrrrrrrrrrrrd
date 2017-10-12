<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>



<div class="match-sect-wrapper">
    <div class="match sidebar-content match-sect-item">
        <div class="match-sect-item-wrapper tbl">
            <a href="" class="dc match-info">
                <div class="team-1-wrap fl">
                    <span class="team-img team-img-featurue"><?php echo Html::img( (!is_null($model->team1))? $model->team1->img : '/img/site/tbd.png'); ?></span>
                    <span class="team-name team-name-featurue"><?= (!is_null($model->team1))? $model->team1->name: 'TBD' ?></span>
                </div>
                <div class="vs fl">
                    <span><img src="/img/site/vs1.png" alt=""></span>
                    <span class="match-time"><?= Yii::$app->formatter->asDate($model->start_time) ?></span>
                    
                </div>
                <div class="team-2-wrap fl">
                    <span class="team-img team-img-featurue"><?php echo Html::img( (!is_null($model->team2))? $model->team2->img : '/img/site/tbd.png'); ?></span>
                    <span class="team-name team-name-featurue"><?= (!is_null($model->team2))? $model->team2->name: 'TBD' ?></span>
                </div>
            </a>
            <div class="tournament-img dc vam" style="background-image: url(<?= $model->tournament->img ?>)"></div>
        </div>
        <div class="match-bets">
            <span>Прогнозов на матч: 10 </span>
            <a href="prognoz-single.html" class="btn btn-watch">Смотреть прогнозы</a>
        </div>
    </div>
</div>