<?php

use yii\db\Migration;

/**
 * Handles the creation of table `teams`.
 */
class m170727_121711_create_teams_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%teams}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'img' => $this->string(255)->notNull(),
            'dotabuff_id' => $this->integer(11)->defaultValue(null),
            'dotabuff_link' => $this->string(255)->defaultValue(null),
            'total_place' => $this->integer(11)->notNull()->defaultValue(0),
            'game_count' => $this->integer(11)->notNull()->defaultValue(0),
            'winrate' => $this->integer(11)->notNull()->defaultValue(0),
            'gametournament_id' => $this->integer()->defaultValue(null)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%teams}}');
    }
}
