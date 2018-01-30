<?php

use yii\db\Migration;

/**
 * Handles the creation of table `totti`.
 */
class m180130_083216_create_totti_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('totti', [
            'id' => $this->primaryKey(),
            'name' => \yii\db\mysql\Schema::TYPE_STRING.'(20) NOT NULL',
            'title' => $this->string(300)->notNull(),
            'content' => $this->text(),
            'create_time' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('totti');
    }
}
