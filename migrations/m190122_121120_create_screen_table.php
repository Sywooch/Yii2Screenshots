<?php

use yii\db\Migration;

/**
 * Handles the creation of table `screen`.
 */
class m190122_121120_create_screen_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('screenshots', [
            'id' => $this->primaryKey(),
            'uploader' => $this->integer()->notNull(),
            'uploaded_at' => $this->timestamp(),
            'file_id' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('screenshots');
    }
}
