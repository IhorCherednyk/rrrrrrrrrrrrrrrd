<?php

use yii\db\Migration;

class m180313_125141_add_user_choice_field_to_forecast_table extends Migration
{
    public function up() {
        $this->addColumn('{{%forecast}}', 'user_choice', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropColumn('{{%forecast}}', 'user_choice');
    }

}
