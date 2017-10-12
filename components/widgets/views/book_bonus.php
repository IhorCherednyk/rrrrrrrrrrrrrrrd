<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>


<?php if (count($data)): ?>
    <div class="best-sale sidebar-block">
        <h4 class="sidebar-header">
            <span><span class="text-main-1">Бонусы</span> букмекеров</span>
        </h4>
        
        <ul class="sidebar-content">
            
            <?php foreach($data as $value): ?>
            
                <li class="book-bonus">
                    <a href="" class="tbl">
                        <span class="bonus-img dc"><?php echo Html::img($value->img_medium); ?></span>
                        <span class="bonus dc va text-right"><?= $value->bonus ?> $</span>
                    </a>
                </li>
                
            <?php endforeach;?>
        </ul>
    </div>

<?php endif; ?>