<?php

use yii\db\Migration;

/**
 * Handles adding search_name to table `teams`.
 */
class m171003_074712_add_search_name_column_to_teams_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%teams}}', 'search_name', $this->string(125));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%teams}}', 'search_name');
    }
}
