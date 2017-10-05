<?php

use yii\db\Migration;

class m171003_092156_add_search_alias_to_team_alias_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%team_alias}}', 'search_alias', $this->string(125));
    }
     /**
     * @inheritdoc
     */
    public function down() {
        $this->dropColumn('{{%team_alias}}', 'search_alias');
    }

}
