<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ScreenshotForm extends Model
{
    public $fileInput;
    public $description;
    public $is_private;
    public $_file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['fileInput'], 'required', 'message'=>"Du musst eine Datei auswählen."],
            [['fileInput'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'bmp']],
            [['description'], 'string'],
            [['is_private'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'fileInput' => 'Wähle deine Datei aus',
            'description' => 'Beschreibung',
            'is_private' => 'Als privat markieren',
        ];
    }

}
