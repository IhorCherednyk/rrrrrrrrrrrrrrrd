<?php

use yii\db\Migration;

/**
 * Handles the creation of table `files`.
 */
class m170705_144000_create_files_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('files', [
            'id' => $this->primaryKey(),
            'dir' => $this->string(250),
            'file_name' => $this->string(250),
            'original_file_name' => $this->string(250),
            'type' => $this->integer(),
            'url' => $this->string(250),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('files');
    }
}
