<?php

namespace app\controllers;

class ApiController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInfo()
    {
        return $this->render('info');
    }

    public function actionUpload()
    {
        return $this->render('upload');
    }

}
