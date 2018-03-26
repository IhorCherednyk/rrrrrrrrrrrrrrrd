<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';
//    D($dataGlobalArray);
?>

<style>
    table,th,td{
        text-align: center;
    }
</style>

<table class="predxi b-table-sortlist table scrollabletable">
    <tr class="tmml">
        <th></th>
        <th title="Личные показатели жк" colspan="3">Личные</th>
        <th title="Общие показатели жк" colspan="3">Общие</th>
        <th title="Общие показатели жк" colspan="3">Тотaл 3.5 % </th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr class="fozn">
        <th>Команда</th>
        <th title="Желтые карточки среднее">среднее</th>
        <th title="Желтые карточки дома">дома</th>
        <th title="Желтые карточки на выезде">в гостях</th>
        <th title="Желтые карточки среднее в матче">среднее</th>
        <th title="Желтые карточки дома в матче">дома</th>
        <th title="Желтые карточки на выезде в матче">в гостях</th>
        <th title="Проход тотала 3.5 среднее в матче">среднее</th>
        <th title="Проход тотала 3.5 дома в матче">дома</th>
        <th title="Проход тотала 3.5 на выезде в матче">в гостях</th>
        <th>Кол-во карточек с этим рефери</th>
        <th>Результат карточек</th>
        <th>Прогноз</th>
    </tr>
   
       <?php foreach ($dataGlobalArray as $key => $data): ?>
        <tr>
            <td><?= $data['team-0']['name'] ?></td>
            <?php if (!empty($data['team-0']['own'])): ?>
                <?php foreach ($data['team-0']['own'] as $ownKey => $own): ?>
                    <td><?= $own ?></td>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($data['team-0']['game'])): ?>
                <?php foreach ($data['team-0']['game'] as $gameKey => $game): ?>
                    <td><?= $game ?></td>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($data['team-0']['tb35'])): ?>
                <?php foreach ($data['team-0']['tb35'] as $tb35Key => $tb35): ?>
                    <td><?= $tb35 ?></td>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($data['team-0']['refery'])): ?>
                    <td>
                <?php foreach ($data['team-0']['refery'] as $referyKey => $ref): ?>
                    <?= $ref . ',' ?>
                <?php endforeach; ?>
                        </td>
            <?php endif; ?>
                        <td></td>
                        <td></td>
        </tr>
        <tr>
                <td><?= $data['team-1']['name'] ?></td>
                <?php if (!empty($data['team-1']['own'])): ?>
                    <?php foreach ($data['team-1']['own'] as $ownKey => $own): ?>
                        <td><?= $own ?></td>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (!empty($data['team-1']['game'])): ?>
                    <?php foreach ($data['team-1']['game'] as $gameKey => $game): ?>
                        <td><?= $game ?></td>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (!empty($data['team-1']['tb35'])): ?>
                    <?php foreach ($data['team-1']['tb35'] as $tb35Key => $tb35): ?>
                        <td><?= $tb35 ?></td>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (!empty($data['team-1']['refery'])): ?>
                    <td>
                        <?php foreach ($data['team-1']['refery'] as $referyKey => $ref): ?>
                            <?= $ref . ',' ?>
                        <?php endforeach; ?>
                    </td>
                <?php endif; ?>
                    <td></td>
                        <td></td>
        </tr>

        <tr class="fozn">
                <th>Судья</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>ТБ3.5</th>
                <th>ТМ3.5</th>
                <th>ТБ3.5-ласт</th>
                <th>ТМ3.5-ласт</th>
                <th></th>
                <th></th>
        </tr>

                <tr>
                    <td><?= $data['refery']['name'] ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= $data['refery']['tb35'] ?></td>
                    <td><?= $data['refery']['tm35'] ?></td>
                    <?php if (!empty($data['refery']['last-3'])): ?>
                        <?php foreach ($data['refery']['last-3'] as $lastKey => $last): ?>
                            <td><?= $last ?></td>
                        <?php endforeach; ?>
                    <?php endif; ?>
                            <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="13"></td>
                </tr>
    <?php endforeach; ?>
</table>
<table class="predxi b-table-sortlist table scrollabletable">

</table>

