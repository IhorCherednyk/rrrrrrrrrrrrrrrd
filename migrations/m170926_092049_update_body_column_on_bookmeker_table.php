<?php

use yii\db\Migration;

class m170926_092049_update_body_column_on_bookmeker_table extends Migration
{
    public function up() {
        $this->alterColumn('{{%bookmeker}}', 'body', 'TEXT DEFAULT NULL');
    }

    public function down() {
    }

}
