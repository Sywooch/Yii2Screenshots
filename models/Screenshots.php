<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "screenshots".
 *
 * @property int $id
 * @property int $uploader
 * @property string $uploaded_at
 * @property string $file_id
 * @property string $description
 * @property string $exif_data
 * @property string $is_private
 * @property string $upload_tag
 */
class Screenshots extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'screenshots';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uploader'], 'required'],
            [['uploader'], 'integer'],
            [['uploaded_at'], 'safe'],
            [['file_id', 'description', 'exif_data'], 'string'],
            [['is_private'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uploader' => 'Uploader',
            'uploaded_at' => 'Uploaded At',
            'file_id' => 'File ID',
            'description' => 'Beschreibung',
            'exif_data' => 'Exif-Informationen',
            'is_private' => 'Privat gestellt',
        ];
    }

    public function delete()
    {
        unlink(Yii::getAlias('@uploadPath')."/".$this->file_id);
        return parent::delete();
    }

    public static function getImageUrl($file_id) {
        return Yii::getAlias("@webUrl")."/d/".$file_id;
    }
}
