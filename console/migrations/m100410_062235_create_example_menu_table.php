<?php

use yii\db\Migration;

/**
 * Handles the creation of table `example_menu`.
 */
class m100410_062235_create_example_menu_table extends Migration
{
    const TABLE_NAME = '{{%example_menu}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB COMMENT="例子表"';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->unique()->comment('菜单名称'),
            'parent_id' => $this->integer(11)->defaultValue(0)->comment('父级菜单ID'),
            'level' => $this->smallInteger(1)->defaultValue(1)->comment('等级'),
            'url' => $this->string(100)->notNull()->comment('菜单链接'),
            'icon' => $this->text()->comment('ICON代码：图标'),
            'intro' => $this->text()->comment('菜单简介'),
            'cate_path' => $this->string(100)->comment('路径'),
            'order' => $this->smallInteger(1)->defaultValue(10)->comment('排序'),
            'status' => $this->smallInteger(1)->defaultValue(1)->comment('状态:1为显示;2为隐藏'),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('p_l_status', self::TABLE_NAME, ['parent_id','level','status'],false);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
