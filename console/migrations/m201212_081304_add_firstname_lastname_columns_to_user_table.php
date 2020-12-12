<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m201212_081304_add_firstname_lastname_columns_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'firstname', $this->string(255)->notNull()->after('id'));
        $this->addColumn('{{%user}}', 'lastname', $this->string(255)->notNull()->after('firstname'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'firstname');
        $this->dropColumn('{{%user}}', 'lastname');
    }
}
