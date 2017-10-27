<?php

use yii\db\Migration;

/**
 * Handles adding steam_id to table `user`.
 */
class m171024_133938_add_steam_id_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up() {
        $this->addColumn('{{%user}}', 'steam_id', $this->bigInteger()->unique());
        $this->alterColumn('{{%user}}', 'password_hash', 'VARCHAR(255) DEFAULT NULL');
        $this->alterColumn('{{%user}}', 'email', 'VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropColumn('{{%user}}', 'steam_id');
    }

}
