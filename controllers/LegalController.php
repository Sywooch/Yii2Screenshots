<?php

namespace app\controllers;

class LegalController extends \yii\web\Controller
{
    public function actionDatenschutz()
    {
        return $this->render('datenschutz');
    }

    public function actionImpressum()
    {
        return $this->render('impressum');
    }

    public function actionAgb()
    {
        return $this->render('agb');
    }

}
