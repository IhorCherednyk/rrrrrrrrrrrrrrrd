<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bookmeker`.
 */
class m170705_072907_create_bookmeker_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('bookmeker', [
            'id' => $this->primaryKey(),
            'name' => $this->string(250),
            'img_medium' => $this->string(250),
            'img_small' => $this->string(250),
            'referal_token' => $this->string(250),
            'body' => $this->text()->notNull(),
            'bonus' => $this->integer(),
            'bonus_link' => $this->string(250),
            'site_link' => $this->string(250)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('bookmeker');
    }
}
