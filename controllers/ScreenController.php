<?php

namespace app\controllers;

use app\models\ScreenshotForm;
use app\models\Screenshots;
use http\Env\Response;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class ScreenController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['upload', 'privacy-toggle', 'delete'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['uploaded', 'show', 'direct'],
                        'roles' => []
                    ]
                ]
            ]
        ];
    }

    public function actionDelete($id) {
        $screen = Screenshots::findOne($id);

        if($screen == null) {
            \Yii::$app->session->setFlash('error', "Das Bild konnte aufgrund unzureichender Berechtigung nicht gelöscht werden.");
            return $this->goHome();
        }

        \Yii::$app->session->setFlash('success', "Das Bild wurde erfolgreich entfernt");
        $screen->delete();
        return $this->redirect(['screen/uploaded']);
    }

    public function actionShow($id)
    {
        $image = Screenshots::find()->where(['file_id'=>$id])->one();
        if($image == null || ($image->is_private && $image->uploader != \Yii::$app->user->getId())) {
            return $this->goHome();
        }

        return $this->render('show', ['model'=>$image]);
    }

    public function actionDirect($id) {
        $image = Screenshots::find()->where(['file_id'=>$id])->one();
        if($image == null || ($image->is_private && $image->uploader != \Yii::$app->user->getId())) {
            return $this->goHome();
        }
        $response = \Yii::$app->getResponse();
        $response->headers->set('Content-Type', 'image/jpeg');
        $response->format = \yii\web\Response::FORMAT_RAW;

        if ( !is_resource($response->stream = fopen(\Yii::getAlias('@uploadPath')."/".$image->file_id, 'r')) ) {
            throw new \yii\web\ServerErrorHttpException('file access failed: permission deny');
        }
        return $response->send();
    }

    public function actionUploaded($own=true) {
        if(\Yii::$app->user->isGuest) {
            $own = false;
        }

        $result = null;
        if($own) {
            $result = Screenshots::find()->where(['uploader'=>\Yii::$app->user->getId()])->all();
        } else {
            $result = Screenshots::find()->where(['is_private'=>false])->all();
        }

        return $this->render('uploaded', [
            'stateOwn' => $own,
            'result' => array_reverse($result)
        ]);
    }

    public function actionPrivacyToggle($id) {
        $model = Screenshots::findOne($id);
        if($model == null || $model->uploader != \Yii::$app->user->getId()) {
            \Yii::$app->session->setFlash('error', "Du bist nicht berechtigt Privatsphäreneinstellungen dieser Datei anzupassen!");
        } else {
            \Yii::$app->session->setFlash('success', "Die Privatsphäreneinstellungen wurde angepasst!");
            $model->is_private = !$model->is_private;
            $model->save();
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionUpload()
    {
        $screenshot = new ScreenshotForm();

        if($screenshot->load(\Yii::$app->request->post())) {
            $screenshot->_file = UploadedFile::getInstance($screenshot, 'fileInput');
            $generate_id = md5(time()."s".rand(0,1000000));
            if($screenshot->_file->saveAs(\Yii::getAlias('@uploadPath')."/".$generate_id.".".$screenshot->_file->extension)) {
                // Userdaten anheften
                $screen = new Screenshots();
                $screen->uploader = \Yii::$app->user->getId();
                $screen->file_id = $generate_id . "." . $screenshot->_file->extension;
                $screen->description = $screenshot->description;
                $screen->is_private = $screenshot->is_private;

                // Exif-Daten extrahieren
                $exif_data = @json_encode(exif_read_data(\Yii::getAlias('@uploadPath')."/".$screen->file_id));
                if($exif_data == null || empty($exif_data)) $exif_data = "{}";
                $screen->exif_data = $exif_data;

                // Model speichern und weiterleiten
                $screen->save();
                return $this->redirect(["s/".$screen->file_id]);
            } else {
                echo "KEIN BILD GESPEICHERT";
                return;
            }
        }

        return $this->render('upload', ['model'=>$screenshot]);
    }

}
