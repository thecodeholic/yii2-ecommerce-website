<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_items}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%products}}`
 * - `{{%orders}}`
 */
class m201124_065209_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_items}}', [
            'id' => $this->primaryKey(),
            'product_name' => $this->string(255)->notNull(),
            'product_id' => $this->integer(11)->notNull(),
            'unit_price' => $this->decimal(10,2)->notNull(),
            'order_id' => $this->integer(11)->notNull(),
            'quantity' => $this->integer(2)->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-order_items-product_id}}',
            '{{%order_items}}',
            'product_id'
        );

        // add foreign key for table `{{%products}}`
        $this->addForeignKey(
            '{{%fk-order_items-product_id}}',
            '{{%order_items}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE'
        );

        // creates index for column `order_id`
        $this->createIndex(
            '{{%idx-order_items-order_id}}',
            '{{%order_items}}',
            'order_id'
        );

        // add foreign key for table `{{%orders}}`
        $this->addForeignKey(
            '{{%fk-order_items-order_id}}',
            '{{%order_items}}',
            'order_id',
            '{{%orders}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%products}}`
        $this->dropForeignKey(
            '{{%fk-order_items-product_id}}',
            '{{%order_items}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-order_items-product_id}}',
            '{{%order_items}}'
        );

        // drops foreign key for table `{{%orders}}`
        $this->dropForeignKey(
            '{{%fk-order_items-order_id}}',
            '{{%order_items}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-order_items-order_id}}',
            '{{%order_items}}'
        );

        $this->dropTable('{{%order_items}}');
    }
}
