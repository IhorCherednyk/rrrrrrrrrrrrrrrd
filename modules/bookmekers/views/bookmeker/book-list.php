<?php

use yii\widgets\ListView;

$this->title = 'Букмекеры';
?>

<section class="main-section book-sec">
    <?php
    echo ListView::widget([
        'dataProvider' => $listDataProvider,
        'itemView' => '_list',
        'layout' => "{items}",

    ]);
    ?>
</section>