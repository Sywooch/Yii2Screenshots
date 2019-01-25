<?php

use yii\db\Migration;

/**
 * Class m190125_013825_update_upload_meta
 */
class m190125_013825_update_upload_meta extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('screenshots', 'description', $this->string()->defaultValue(null));
        $this->addColumn('screenshots', 'exif_data', $this->text());
        $this->addColumn('screenshots', 'is_private', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('screenshots', 'description');
        $this->dropColumn('screenshots', 'exif_data');
        $this->dropColumn('screenshots', 'is_private');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190125_013825_update_upload_meta cannot be reverted.\n";

        return false;
    }
    */
}
