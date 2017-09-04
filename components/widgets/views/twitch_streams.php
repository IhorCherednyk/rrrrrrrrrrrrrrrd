<?php

use yii\helpers\Html;
?>
<?php if (count($data)): ?>
    <div class="sidebar-block popular-video ">
        <h4 class="sidebar-header">
            <span><span class="text-main-1">Лучшие </span> стримы</span>
        </h4>

        <ul class="stream-ul">
            <?php foreach ($data as $stream) : ?> 
                <li class="stream sidebar-content">

                    <a href="#" class="stram-img-wrapper">
                        <span class="stream-info-wrapper">
                            <span class="stream-from"><i class="fa fa-video-camera"></i> <?= $stream->channel->display_name ?></span>
                            <span class="viewers"><i class="fa fa-eye"></i> <?= $stream->viewers ?></span>
                        </span>
                        <?= Html::img($stream->preview->medium) ?>
                        <span class="fa fa-play"></span>
                    </a>

                </li>
            <?php endforeach; ?>
        </ul>
    </div>



<?php endif; ?>



