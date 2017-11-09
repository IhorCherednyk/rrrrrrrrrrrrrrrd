<?php

use yii\db\Migration;

/**
 * Handles adding match_type to table `matches`.
 */
class m171104_132526_add_match_type_column_to_matches_table extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->addColumn('{{%matches}}', 'match_type', $this->integer(11)->defaultValue(1)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropColumn('{{%matches}}', 'match_type');
    }

}
