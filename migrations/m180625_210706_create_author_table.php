<?php

use yii\db\Migration;

/**
 * Handles the creation of table `author`.
 */
class m180625_210706_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('author', [
            'id' => $this->primaryKey(10),
            'portrait' => $this->text(224),
            'name' => $this->text(224),
            'surname' => $this->text(224),
            'patronymic' => $this->text(224),
            'date_start' => $this->datetime(),
            'place_start' => $this->text(224),
            'date_end' => $this->datetime(),
            'place_end' => $this->text(224),
            'biography' => $this->text(),
            'works' => $this->text() 
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('author');
    }
}
