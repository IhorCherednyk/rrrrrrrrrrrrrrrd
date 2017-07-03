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
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->notNull(),
            'email' => $this->string(250)->notNull(),
            'password_hash' => $this->string(250)->notNull(),
            'status' => $this->integer(11)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'first_name' => $this->string(250),
            'last_name' => $this->string(250),
            'role' => $this->integer(11)->defaultValue(3),
            'last_login_date' => $this->integer(11),
            'email_activation_key' => $this->string(6)->notNull(),
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
