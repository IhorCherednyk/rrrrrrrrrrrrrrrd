<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $this->title = 'Стримы'?>
<?php if (count($data)): ?>
    
    <section class="main-section streams">
        <div class="row">
            <?php foreach ($data as $stream) : ?>
                <div class="col-md-6">
                    <a href="<?= Url::to(['/streams/stream/view-stream', 'name' => $stream->channel->name, 'id' => $stream->channel->_id]) ?>" class="box-stream-wrapper" style="background-image: url(<?= $stream->preview->medium ?>)">
                        <div class="box-stream-overlay">
                            <span class="box-stream-content">
                                <span class="channel">
                                    <?= $stream->channel->display_name ?>               
                                </span>
                                <span class="language">
                                    Язык: <?= $stream->channel->broadcaster_language ?>              
                                </span> 
                                <span class="viewers"><i class="fa fa-eye fa-fw"></i><?= $stream->viewers ?></span>
                            </span>
                            <span class="twitch-logo">
                                <?= Html::img($stream->channel->logo) ?>
                            </span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

<?php endif; ?>