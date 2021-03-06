<?php

namespace app\controllers;

use app\models\ScreenshotForm;
use app\models\Screenshots;
use app\models\Users;
use yii\filters\AccessControl;

class ShareController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    public function actionUploadImage()
    {
        if(isset($_POST['api_key']) && isset($_POST['upload_private'])) {
            $user = Users::findOne(['api_key' => $_POST['api_key']]);
            $privacy = $_POST['upload_private'];
        } else {
            return false;
        }

        if($user == null) return false;

        foreach($_FILES as $file) {
            $generate_id = md5(time()."s".rand(0,1000000));
            $filename = $generate_id.".".explode("/", $file['type'])[1];
            move_uploaded_file($file['tmp_name'], \Yii::getAlias('@uploadPath')."/".$filename);

            // Userdaten anheften
            $screen = new Screenshots();
            $screen->uploader = $user->id;
            $screen->file_id = $filename;
            $screen->description = null;
            $screen->is_private = ($privacy == "false") ? false : true;
            $screen->upload_tag = "ShareX";

            // Exif-Daten extrahieren
            $exif_data = @json_encode(exif_read_data(\Yii::getAlias('@uploadPath')."/".$filename));
            if($exif_data == null || empty($exif_data)) $exif_data = "{}";
            $screen->exif_data = $exif_data;

            // Model speichern und weiterleiten
            $screen->save();
            return json_encode([
                "url_direct" => \Yii::getAlias('@webUrl')."/s/".$filename, // Redirect to Graph-Image / image detail page
                "url_thumbnail" => \Yii::getAlias('@webUrl')."/t/".$filename,
                "url_forcedelete" => \Yii::getAlias('@webUrl')."/r/".$screen->id,
            ]);
        }

        return;
    }

}
