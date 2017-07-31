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
        $this->createTable('teams', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'second_name' => $this->string(255),
            'img' => $this->string(255)->notNull(),
            'dotabuff_id' => $this->integer(11)->notNull(),
            'dotabuff_link' => $this->string(255)->notNull(),
            'total_place' => $this->integer(11)->notNull(),
            'game_count' => $this->integer(11)->notNull(),
            'winrate' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('teams');
    }
}
