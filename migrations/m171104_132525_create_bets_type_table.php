<?php

use yii\db\Migration;
use app\modules\forecasts\models\Matches;

/**
 * Handles the creation of table `bets_type`.
 * Has foreign keys to the tables:
 *
 * - `matches`
 */
class m171104_132525_create_bets_type_table extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('{{%bets_type}}', [
            'id' => $this->primaryKey(),
            'match_type_data' => $this->integer(11)->notNull(),
            'match_bets' => $this->string(255)->notNull()
        ]);

        $this->batchInsert('{{%bets_type}}', ['match_type_data', 'match_bets'], [
            // BO1
                [Matches::TYPE_BO1, 'win1'],
                [Matches::TYPE_BO1, 'win2'],
                [Matches::TYPE_BO1, 'draw'],
                [Matches::TYPE_BO1, 'win1(1:0)'],
                [Matches::TYPE_BO1, 'win2(0:1)'],
            // BO2
            [Matches::TYPE_BO2, 'win1'],
                [Matches::TYPE_BO2, 'win2'],
                [Matches::TYPE_BO2, 'draw'],
                [Matches::TYPE_BO2, 'win1(2:0)'],
                [Matches::TYPE_BO2, 'win2(0:2)'],
                [Matches::TYPE_BO3, 'fora1(0.5)'],
                [Matches::TYPE_BO3, 'fora1(-0.5)'],
                [Matches::TYPE_BO3, 'fora2(0.5)'],
                [Matches::TYPE_BO3, 'fora2(-0.5)'],
            // BO3
            [Matches::TYPE_BO3, 'win1'],
                [Matches::TYPE_BO3, 'win2'],
                [Matches::TYPE_BO3, 'draw'],
                [Matches::TYPE_BO3, 'fora1(1.5)'],
                [Matches::TYPE_BO3, 'fora1(-1.5)'],
                [Matches::TYPE_BO3, 'fora2(1.5)'],
                [Matches::TYPE_BO3, 'fora2(-1.5)'],
                [Matches::TYPE_BO3, 'win1(2:0)'],
                [Matches::TYPE_BO3, 'win1(2:1)'],
                [Matches::TYPE_BO3, 'win2(0:2)'],
                [Matches::TYPE_BO3, 'win2(1:2)'],
            // BO5
            [Matches::TYPE_BO5, 'win1'],
                [Matches::TYPE_BO5, 'win2'],
                [Matches::TYPE_BO5, 'draw'],
                [Matches::TYPE_BO5, 'fora1(1.5)'],
                [Matches::TYPE_BO5, 'fora1(-1.5)'],
                [Matches::TYPE_BO5, 'fora2(1.5)'],
                [Matches::TYPE_BO5, 'fora2(-1.5)'],
                [Matches::TYPE_BO5, 'win1(3:0)'],
                [Matches::TYPE_BO5, 'win1(3:1)'],
                [Matches::TYPE_BO5, 'win1(3:2)'],
                [Matches::TYPE_BO5, 'win2(0:3)'],
                [Matches::TYPE_BO5, 'win2(1:3)'],
                [Matches::TYPE_BO5, 'win2(2:3)'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('bets_type');
    }

}
