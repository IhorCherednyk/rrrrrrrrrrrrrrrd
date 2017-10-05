<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>



<div class="match-sect-wrapper">
    <div class="match sidebar-content match-sect-item">
        <div class="match-sect-item-wrapper tbl">
            <a href="" class="dc match-info">
                <div class="team-1-wrap fl">
                    <span class="team-img team-img-featurue"><?php echo Html::img( ($model->team1->img)? $model->team1->img : '/img/site/tbd.png', ['alt' => $model->team1->name]); ?></span>
                    <span class="team-name team-name-featurue"><?= ($model->team1->name)? $model->team1->name: 'TBD' ?></span>
                </div>
                <div class="vs fl">
                    <span><img src="/img/site/vs1.png" alt=""></span>
                    <span class="match-time"><?= Yii::$app->formatter->asDate($model->start_time) ?></span>
                    
                </div>
                <div class="team-2-wrap fl">
                    <span class="team-img team-img-featurue"><?php echo Html::img( ($model->team2->img)? $model->team2->img : '/img/site/tbd.png', ['alt' => $model->team2->name]); ?></span>
                    <span class="team-name team-name-featurue"><?= ($model->team2->name)? $model->team2->name: 'TBD' ?></span>
                </div>
            </a>
            <div class="tournament-img dc vam">
                <?php echo Html::img( $model->tournament->img , ['alt' => $model->tournament->name]); ?>
            </div>
        </div>
        <div class="match-bets">
            <span>Прогнозов на матч: 10 </span>
            <a href="prognoz-single.html" class="btn btn-watch">Смотреть прогнозы</a>
        </div>
    </div>
</div>