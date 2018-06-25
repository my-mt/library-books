<?php

use yii\db\Migration;

/**
 * Handles the creation of table `section`.
 */
class m180625_211223_create_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('section', [
            'id' => $this->primaryKey(10),
            'name' => $this->text(224),
            'parent_section_id' => $this->integer(10)->notNull(),
            'cover' => $this->text(224),
            'description' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('section');
    }
}
