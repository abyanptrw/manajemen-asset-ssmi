<?php

use yii\db\Migration;

/**
 * Handles the creation of table `asset`.
 */
class m250612_120100_create_asset_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%asset}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'category_id' => $this->integer()->notNull(),
            'location' => $this->string(100),
            'status' => $this->string(20)->notNull()->defaultValue('available'),
            'qr_code' => $this->string(255)->unique(),
            'purchase_date' => $this->date(),
            'user' => $this->string(255),
            'economic_life' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Add indexes
        $this->createIndex(
            '{{%idx-asset-name}}',
            '{{%asset}}',
            'name'
        );

        $this->createIndex(
            '{{%idx-asset-category_id}}',
            '{{%asset}}',
            'category_id'
        );

        $this->createIndex(
            '{{%idx-asset-status}}',
            '{{%asset}}',
            'status'
        );

        // Add foreign key (commented for SQLite compatibility, uncomment for MySQL)
        // $this->addForeignKey(
        //     '{{%fk-asset-category_id}}',
        //     '{{%asset}}',
        //     'category_id',
        //     '{{%asset_category}}',
        //     'id',
        //     'CASCADE'
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign key if exists (MySQL)
        // $this->dropForeignKey('{{%fk-asset-category_id}}', '{{%asset}}');

        $this->dropTable('{{%asset}}');
    }
}
