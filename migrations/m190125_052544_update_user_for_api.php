<?php

use yii\db\Migration;

/**
 * Class m190125_052544_update_user_for_api
 */
class m190125_052544_update_user_for_api extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'api_key', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'api_key');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190125_052544_update_user_for_api cannot be reverted.\n";

        return false;
    }
    */
}
