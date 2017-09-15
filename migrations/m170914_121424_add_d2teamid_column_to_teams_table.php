<?php

use yii\db\Migration;

/**
 * Handles adding d2teamid to table `teams`.
 */
class m170914_121424_add_d2teamid_column_to_teams_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('teams', 'd2teamid', $this->integer()->defaultValue(null));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('teams', 'd2teamid');
    }
}
