<?php

use yii\db\Migration;

/**
 * Handles adding economic_life to table `{{%asset}}`.
 */
class m250602_182537_add_economic_life_to_asset extends Migration
{
    public function safeUp()
    {
        try {
            $this->addColumn('{{%asset}}', 'economic_life', $this->integer()->notNull()->defaultValue(5)->comment('Umur Ekonomis (tahun)'));
        } catch (\Exception $e) {
            // Already added
        }
    }

    public function safeDown()
    {
        $this->dropColumn('{{%asset}}', 'economic_life');
    }
}
