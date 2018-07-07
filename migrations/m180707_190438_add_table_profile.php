<?php

use yii\db\Migration;

/**
 * Class m180707_190438_add_table_profile
 */
class m180707_190438_add_table_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('profile', [
            'user_id' => $this->integer(10)->notNull(),
            'avatar' => $this->text(225),
            'first_name' => $this->text(225),
            'second_name' => $this->text(225),
            'middle_name' => $this->text(225),
            'birthday' => $this->date(),
            'gender' => $this->smallInteger(6),

        ]);
        $this->addForeignKey('profile_user_id', 'profile', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180707_190438_add_table_profile cannot be reverted.\n";
        $this->dropTable('profile');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180707_190438_add_table_profile cannot be reverted.\n";

        return false;
    }
    */
}
