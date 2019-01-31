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
Beigetreten: <?= $user->created_date ?><br>
Erstellte Screenshots: <?= count($user->screenshots); ?>

<h2>Veröffentlicht</h2>
<div class="row">
    <?php
    foreach($user->screenshots as $upload) {
        if(!$upload->is_private) {
            ?>
            <div class="col-md-2">
                <div class="thumbnail">
                    <img src="<?= \app\models\Screenshots::getImageUrl($upload->file_id) ?>" class="portrait">
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>