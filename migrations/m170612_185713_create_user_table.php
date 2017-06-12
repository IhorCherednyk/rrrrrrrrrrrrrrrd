<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170612_185713_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->notNull(),
            'email' => $this->string(255)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'status' => $this->integer(11)->notNull(),
            'auth_key' => $this->integer(11)->notNull(),
            'create_at' => $this->integer(11)->notNull(),
            'update_at' => $this->integer(11)->notNull(),
            'first_name' => $this->string(255),
            'last_name' => $this->string(255),
            'role' => $this->integer(11)->defaultValue(1),
            'last_login_date' => $this->integer(11),
            'email_activation_key' => $this->integer(11)->notNull(),
            'note' => $this->text(),
            'skype' => $this->string(100),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
