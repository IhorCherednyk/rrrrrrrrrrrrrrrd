<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages`.
 */
class m170703_091058_create_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(250)->notNull(),
            'body' => $this->text(),
            'title' => $this->string(250)->notNull(),
            'title_short' => $this->string(150)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'keywords' => $this->string(250),
            'description' => $this->string(250),
            'status' => 'tinyint(1) DEFAULT "0"',
            'is_protected' => $this->boolean()->notNull()->defaultValue(0),

            
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%pages}}');
    }
}
