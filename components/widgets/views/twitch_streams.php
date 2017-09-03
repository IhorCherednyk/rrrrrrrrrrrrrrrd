<?php

use yii\helpers\Html;
?>
<?php if (count($data)): ?>
    <div class="large-12 medium-12 columns">
        <div class="widgetBox">
            <div class="widgetContent">
                <ul class="accordion">
                    <li class="accordion-item is-active">
                        <span class="accordion-title"><i class="fa fa-video-camera"></i>&nbsp;<?= Yii::t('app', 'Top Dota 2 Live Streams') ?></span>
                        <div class="accordion-content">
                            <ul>
                                <?php foreach ($data as $stream) : ?>
                                    <li>
                                        <?= Html::a(
                                                '<i class="fa fa-video-camera"></i>'.$stream->channel->display_name.'<span><i class="fa fa-eye"></i>'.$stream->viewers.'</span>', 
                                                ['/video/index/stream', 'name' => $stream->channel->name, 'id' => $stream->channel->_id]) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>



