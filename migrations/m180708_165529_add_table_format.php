<?php

use yii\db\Migration;

/**
 * Class m180708_165529_add_table_format
 */
class m180708_165529_add_table_format extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('format', [
            'id' => $this->primaryKey(),
            'format_str' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180708_165529_add_table_format cannot be reverted.\n";

        $this->dropTable('format');
    }

}
