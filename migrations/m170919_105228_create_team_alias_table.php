<?php

use yii\db\Migration;

/**
 * Handles the creation of table `team_alias`.
 * Has foreign keys to the tables:
 *
 * - `teams`
 */
class m170919_105228_create_team_alias_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('team_alias', [
            'id' => $this->primaryKey(),
            'team_id' => $this->integer()->notNull(),
            'alias' => $this->text(),
        ]);

        // creates index for column `team_id`
        $this->createIndex(
            'idx-team_alias-team_id',
            'team_alias',
            'team_id'
        );

        // add foreign key for table `teams`
        $this->addForeignKey(
            'fk-team_alias-team_id',
            'team_alias',
            'team_id',
            'teams',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `teams`
        $this->dropForeignKey(
            'fk-team_alias-team_id',
            'team_alias'
        );

        // drops index for column `team_id`
        $this->dropIndex(
            'idx-team_alias-team_id',
            'team_alias'
        );

        $this->dropTable('team_alias');
    }
}
