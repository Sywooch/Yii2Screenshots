<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m190122_111525_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'auth_key' => $this->string(),
            'email' => $this->string()->notNull(),
            'created_ip' => $this->string(),
            'created_date' => $this->timestamp(),
            'login_ip' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
