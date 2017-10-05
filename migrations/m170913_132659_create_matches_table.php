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
            'gametournament_id' => $this->integer(11)->notNull(),
            'team1_id' => $this->integer(11),
            'team2_id' => $this->integer(11),
            'tournament_id' => $this->integer(11)->notNull(),
            'start_time' => $this->integer()->notNull(),
            'team1_result' => $this->integer()->defaultValue(NULL),
            'team2_result' => $this->integer()->defaultValue(NULL),
            'status' => $this->integer()->defaultValue(0),
            'koff_counter' => $this->integer()->defaultValue(0)
            
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
