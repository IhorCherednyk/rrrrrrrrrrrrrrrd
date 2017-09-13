<?php

use yii\db\Migration;

/**
 * Handles the creation of table `matches_koff`.
 * Has foreign keys to the tables:
 *
 * - `matches`
 * - `bookmeker`
 */
class m170913_140937_create_matches_koff_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('matches_koff', [
            'id' => $this->primaryKey(),
            'match_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull(),
            'team1_koff' => $this->integer(),
            'team2_koff' => $this->integer(),
        ]);

        // creates index for column `match_id`
        $this->createIndex(
            'idx-matches_koff-match_id',
            'matches_koff',
            'match_id'
        );

        // add foreign key for table `matches`
        $this->addForeignKey(
            'fk-matches_koff-match_id',
            'matches_koff',
            'match_id',
            'matches',
            'id',
            'CASCADE'
        );

        // creates index for column `book_id`
        $this->createIndex(
            'idx-matches_koff-book_id',
            'matches_koff',
            'book_id'
        );

        // add foreign key for table `bookmeker`
        $this->addForeignKey(
            'fk-matches_koff-book_id',
            'matches_koff',
            'book_id',
            'bookmeker',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `matches`
        $this->dropForeignKey(
            'fk-matches_koff-match_id',
            'matches_koff'
        );

        // drops index for column `match_id`
        $this->dropIndex(
            'idx-matches_koff-match_id',
            'matches_koff'
        );

        // drops foreign key for table `bookmeker`
        $this->dropForeignKey(
            'fk-matches_koff-book_id',
            'matches_koff'
        );

        // drops index for column `book_id`
        $this->dropIndex(
            'idx-matches_koff-book_id',
            'matches_koff'
        );

        $this->dropTable('matches_koff');
    }
}
