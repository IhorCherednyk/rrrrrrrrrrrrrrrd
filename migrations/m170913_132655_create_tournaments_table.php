<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tournaments`.
 */
class m170913_132655_create_tournaments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tournaments', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'img' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tournaments');
    }
}
