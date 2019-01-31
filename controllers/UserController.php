<?php

namespace app\controllers;

use app\models\Users;
use yii\filters\AccessControl;

class UserController extends \yii\web\Controller
{
    /*
    public function actionAlbum($id)
    {
        $user = Users::findOne($id);
        if($user == null) return $this->goHome();

        return $this->render('album', [
            'user' => $user,
        ]);
    }*/

    public function actionProfile($id)
    {
        $user = Users::findOne($id);
        if($user == null) return $this->goHome();

        return $this->render('profile', [
            'user' => $user,
        ]);
    }

}
