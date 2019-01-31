<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = "Community";
$this->params['breadcrumbs'][] = ['label' => 'Mein Konto', 'url' => ['/site/account']];;
$this->params['breadcrumbs'][] = "Album";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
