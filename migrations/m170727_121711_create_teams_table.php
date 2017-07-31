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
            'second_name' => $this->string(255)->notNull(),
            'img' => $this->string(255)->notNull(),
            'dotabuff_id' => $this->integer(11),
            'total_place' => $this->integer(11),
            'game_count' => $this->integer(11),
            'winrate' => $this->integer(11),
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
