<?php

use yii\db\Migration;

/**
 * Handles the creation of table `place`.
 */
class m180625_211820_create_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('place', [
            'id' => $this->primaryKey(10),
            'place_name' => $this->text(224),
            'description' => $this->text(),
            'images' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('place');
    }
}
