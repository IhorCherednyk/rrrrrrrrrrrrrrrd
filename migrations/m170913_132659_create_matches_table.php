<?php

use yii\db\Migration;

/**
 * Handles the creation of table `matches`.
 */
class m170913_132659_create_matches_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%matches}}', [
            'id' => $this->primaryKey(),
            'id_dt2' => $this->integer(11)->notNull(),
            'id_team1' => $this->integer(11)->notNull(),
            'id_team2' => $this->integer(11)->notNull(),
            'tournament_id' => $this->integer(11)->notNull(),
            'start_time' => $this->integer()->notNull(),
            'team1_koff' => $this->integer()->notNull(),
            'team2_koff' => $this->integer()->notNull(),
        ]);
        
        // creates index for column `match_id`
        $this->createIndex(
            'idx-matches-tournament_id',
            '{{%matches}}',
            'tournament_id'
        );

        // add foreign key for table `matches`
        $this->addForeignKey(
            'fk-matches-tournament_id',
            '{{%matches}}',
            'tournament_id',
            'tournaments',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    
    
    public function down()
    {
        $this->dropTable('{{%matches}}');
    }
}
