<?php 
    use yii\widgets\ListView;
    $this->title = 'Расписание';
?>
<section class="main-section match-sect">
    <?php
    echo ListView::widget([
        'dataProvider' => $listDataProvider,
        'itemView' => '_list',
        'layout' => "{items}",

    ]);
    ?>
</section>