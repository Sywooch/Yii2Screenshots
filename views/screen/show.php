<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Screenshot';
$this->params['breadcrumbs'][] = ['label' => 'Uploads', 'url'=>['screen/uploaded']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-5">
        <img src="/d/<?= $model->file_id ?>" style="max-width: 100%">
    </div>
    <div class="col-md-7">
        <table class="table">
            <tr><td>Hochgeladen von</td><td><?= Html::encode(\app\models\Users::findOne($model->uploader)->username) ?></td></tr>
            <tr><td>Beschreibung</td><td><?= ($model->description == null) ? "-" : Html::encode($model->description) ?></td></tr>
            <tr><td>Zeitstempel</td><td><?= $model->uploaded_at ?></td></tr>
            <tr><td>Privat markiert</td><td><?= ($model->is_private) ? "Ja" : "Nein" ?></td></tr>
            <tr><td>Direkt-Link</td><td><?= Html::a("Direkter Link zum Bild", "/d/".$model->file_id)?></td></tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#exifInformations" aria-expanded="false" aria-controls="exifInformations">
                        Exif-Informationen anzeigen
                    </button>
                    <?php if($model->uploader == Yii::$app->user->getId()) { ?>
                    <a class="btn btn-warning" href="<?= \yii\helpers\Url::to(["/screen/privacy-toggle", "id"=>$model->id]) ?>">
                        <?= ($model->is_private) ? "Öffentlich machen" : "Privat stellen" ?>
                    </a>
                    <a class="btn btn-danger" href="<?= \yii\helpers\Url::to(["/screen/delete", "id"=>$model->id]) ?>">
                        Löschen
                    </a>
                    <?php } ?>
                </td>
            </tr>
        </table>

        <div class="collapse" id="exifInformations">
            <div class="card card-body">
                <?php if(json_decode($model->exif_data) != []) { ?>
                <table class="table" style="width: 500px">
                <?php
                $exif_info = json_decode($model->exif_data);
                foreach($exif_info as $a => $b) {
                    if(!is_object($b)) {
                        ?>
                        <tr>
                            <td><?= $a ?></td>
                            <td><?php print_r($b) ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </table>
                <?php } else { ?>
                    Keine Exif-Informationen übermittelt
                <?php } ?>
            </div>
        </div>
    </div>
</div>