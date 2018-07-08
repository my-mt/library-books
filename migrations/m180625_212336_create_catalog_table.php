<?php

use yii\db\Migration;

/**
 * Handles the creation of table `catalog`.
 */
class m180625_212336_create_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('catalog', [
            'id' => $this->primaryKey(),
            'name' => $this->text(224),
            'author_id' => $this->integer(10)->notNull(),
            'description' => $this->text(),
            'section_id' => $this->integer(10)->notNull(),
            'link_file' => $this->text(),
            'year_made' => $this->integer(4),
            'year_writing' => $this->integer(4),
            'format_id' => $this->integer(10)->notNull(),
            'language' => $this->string(8),
            'quantity' => $this->integer(3)->notNull(),
            'place_id' => $this->integer(10)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'cover' => $this->text(224),
            'images' => $this->text(224),
            'quality' => $this->integer(1),   
        ]);
        $this->addForeignKey('catalog_user_id', 'catalog', 'user_id', 'user', 'id');
        $this->addForeignKey('catalog_author_id', 'catalog', 'author_id', 'author', 'id');
        $this->addForeignKey('catalog_section_id', 'catalog', 'section_id', 'section', 'id');
        $this->addForeignKey('catalog_place_id', 'catalog', 'place_id', 'place', 'id');
        $this->addForeignKey('catalog_format_id', 'catalog', 'format_id', 'format', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('catalog');
    }
}
