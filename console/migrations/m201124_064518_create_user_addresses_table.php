<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_addresses}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m201124_064518_create_user_addresses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_addresses}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'address' => $this->string(255)->notNull(),
            'city' => $this->string(255)->notNull(),
            'state' => $this->string(255)->notNull(),
            'country' => $this->string(255)->notNull(),
            'zipcode' => $this->string(255),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_addresses-user_id}}',
            '{{%user_addresses}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_addresses-user_id}}',
            '{{%user_addresses}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-user_addresses-user_id}}',
            '{{%user_addresses}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_addresses-user_id}}',
            '{{%user_addresses}}'
        );

        $this->dropTable('{{%user_addresses}}');
    }
}
