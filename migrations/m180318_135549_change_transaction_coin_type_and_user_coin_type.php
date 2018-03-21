<?php

use yii\db\Migration;

class m180318_135549_change_transaction_coin_type_and_user_coin_type extends Migration
{
    public function up() {
        $this->alterColumn('{{%user}}', 'coins', 'FLOAT');
        $this->alterColumn('{{%transactions}}', 'coins', 'FLOAT');
    }

    public function down() {
        $this->alterColumn('{{%user}}', 'coins', 'FLOAT');
        $this->alterColumn('{{%transactions}}', 'coins', 'FLOAT');
    }
}
