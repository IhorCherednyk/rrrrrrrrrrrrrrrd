<?php

use yii\db\Migration;

class m180209_080858_coins_transaction_table extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {

        $this->createTable('{{%transactions}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->notNull(),
            'coins' => $this->integer()->notNull(),
            'reciver_coin' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(0)
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down() {

        $this->dropTable('{{%transactions}}');
    }

}
