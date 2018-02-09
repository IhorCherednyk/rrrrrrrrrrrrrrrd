<?php

use yii\db\Migration;

class m180209_080910_add_coins_to_user_table extends Migration
{
     public function up()
    {
        $this->addColumn('{{%user}}', 'coins', $this->integer()->defaultValue(1000));
    }
     /**
     * @inheritdoc
     */
    public function down() {
        $this->dropColumn('{{%user}}', 'coins');
    }
}
