<?php

use yii\db\Migration;

/**
 * Handles the creation of table `forecast`.
 * Has foreign keys to the tables:
 *
 * - `matches`
 * - `user`
 * - `bookmeker`
 */
class m171105_133322_create_forecast_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%forecast}}', [
            'id' => $this->primaryKey(),
            'match_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'bookmeker_id' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(0),
            'bookmeker_koff' => $this->integer()->notNull(),
            'user_koff' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

        // creates index for column `match_id`
        $this->createIndex(
            'idx-forecast-match_id',
            'forecast',
            'match_id'
        );

        // add foreign key for table `matches`
        $this->addForeignKey(
            'fk-forecast-match_id',
            'forecast',
            'match_id',
            'matches',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-forecast-user_id',
            'forecast',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-forecast-user_id',
            'forecast',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `bookmeker_id`
        $this->createIndex(
            'idx-forecast-bookmeker_id',
            'forecast',
            'bookmeker_id'
        );

        // add foreign key for table `bookmeker`
        $this->addForeignKey(
            'fk-forecast-bookmeker_id',
            'forecast',
            'bookmeker_id',
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
            'fk-forecast-match_id',
            'forecast'
        );

        // drops index for column `match_id`
        $this->dropIndex(
            'idx-forecast-match_id',
            'forecast'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-forecast-user_id',
            'forecast'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-forecast-user_id',
            'forecast'
        );

        // drops foreign key for table `bookmeker`
        $this->dropForeignKey(
            'fk-forecast-bookmeker_id',
            'forecast'
        );

        // drops index for column `bookmeker_id`
        $this->dropIndex(
            'idx-forecast-bookmeker_id',
            'forecast'
        );

        $this->dropTable('forecast');
    }
}
