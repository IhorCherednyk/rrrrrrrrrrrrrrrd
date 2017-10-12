<?php

use yii\db\Migration;

/**
 * Handles adding avatar_path to table `user`.
 */
class m171012_104013_add_avatar_path_column_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'avatar_path', $this->string(255));
    }
     /**
     * @inheritdoc
     */
    public function down() {
        $this->dropColumn('{{%user}}', 'avatar_path');
    }

}
