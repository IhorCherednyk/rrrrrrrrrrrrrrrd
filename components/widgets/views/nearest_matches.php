<?php use yii\helpers\Html; ?>

<?php if (count($data)): ?>
    <div class="sidebar-block closest-match">
        <h4 class="sidebar-header">
            <span><span class="text-main-1">Ближайшие</span> игры</span>
        </h4>
        
        <ul>
            
           <?php foreach ($data as $model): ?>
                <li class="match sidebar-content nearestmatches">
                    <a href="" class="tbl">
                        <div class="team-1-wrap dc">
                            <span class="team-img team-img-featurue"><?php echo Html::img( (!is_null($model->team1))? $model->team1->img : '/img/site/tbd.png'); ?></span>
                            <span class="team-name team-name-featurue"><?= (!is_null($model->team1))? $model->team1->name: 'TBD' ?></span>
                        </div>
                        <div class="vs dc">
                            <span><img src="/img/site/vs1.png" alt=""></span>
                            <span class="match-time"><?= Yii::$app->formatter->asDate($model->start_time) ?></span>
                        </div>
                        <div class="team-2-wrap dc">
                            <span class="team-img team-img-featurue"><?php echo Html::img( (!is_null($model->team2))? $model->team2->img : '/img/site/tbd.png'); ?></span>
                            <span class="team-name team-name-featurue"><?= (!is_null($model->team2))? $model->team2->name: 'TBD' ?></span>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
                
        </ul>
    </div>

<?php endif; ?>



