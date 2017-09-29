<?php

use yii\db\Migration;

/**
 * Handles adding gametournament_alias to table `bookmeker`.
 */
class m170926_081513_add_gametournament_alias_column_to_bookmeker_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('bookmeker', 'gametournament_alias', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('bookmeker', 'gametournament_alias');
    }
}
