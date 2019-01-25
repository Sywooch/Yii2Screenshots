<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout', 'account', 'account-api-reset'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'login', 'logout', 'register'],
                        'allow' => true,
                        'roles' => []
                    ]
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAccount() {
        $account = Users::findOne(Yii::$app->user->getId());

        // Get API Key if not set
        if($account->api_key == null) {
            $account->api_key = md5($account->username.$account->email.time()."apiDeCodEr");
            $account->save();
        }

        return $this->render('account', [
            'model' => $account
        ]);
    }

    public function actionAccountApiReset() {
        $account = Users::findOne(Yii::$app->user->getId());
        $account->api_key = md5($account->username.$account->email.time()."apiDeCodEr");
        $account->save();
        \Yii::$app->session->setFlash('success', "Dein API-Schlüssel wurde erfolgreich zurückgesetzt!");
        \Yii::$app->session->setFlash('info', "Solltest du ShareX als Uploader benutzen, aktualisiere bitte deinen API-Schlüssel!");
        return $this->redirect(["site/account"]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegister()
    {
        $model = new \app\models\Users();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->password = md5($model->password);
                $model->created_ip = $_SERVER['REMOTE_ADDR'];
                $model->login_ip = $_SERVER['REMOTE_ADDR'];
                $model->save();
                return $this->goHome();
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

}
