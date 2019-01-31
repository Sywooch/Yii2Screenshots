<?php

use yii\db\Migration;

/**
 * Class m190126_195628_create_upload_tag
 */
class m190126_195628_create_upload_tag extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('screenshots', 'upload_tag', $this->string()->defaultValue("Upload"));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('screenshots', 'upload_tag');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190126_195628_create_upload_tag cannot be reverted.\n";

        return false;
    }
    */
}
