<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user app\models\Users */
/* @var $form ActiveForm */
$this->title = $user->username;

$this->params['breadcrumbs'][] = "Community";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
Beigetreten: <?= $user->created_date ?>


