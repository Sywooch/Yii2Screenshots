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
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col-md-4">
        <img src="/uploads/<?= $model->file_id ?>" style="max-width: 100%">
    </div>
    <div class="col-md-8">
        <table class="table" style="width: 500px">
            <tr><td>Hochgeladen von</td><td><?= \app\models\Users::findOne($model->uploader)->username ?></td></tr>
            <tr><td>Beschreibung</td><td><?= ($model->description == null) ? "-" : Html::encode($model->description) ?></td></tr>
            <tr><td>Zeitstempel</td><td><?= $model->uploaded_at ?></td></tr>
            <tr><td>Privat markiert</td><td><?= ($model->is_private) ? "Ja" : "Nein" ?></td></tr>
            <tr><td>Direkt-Link</td><td><?= Html::a("Direkter Link zum Bild", "/uploads/".$model->file_id)?></td></tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#exifInformations" aria-expanded="false" aria-controls="exifInformations">
                        Exif-Informationen anzeigen
                    </button>
                    <a class="btn btn-warning" href="<?= \yii\helpers\Url::to(["/screen/privacy-toggle", "id"=>$model->id]) ?>">
                        <?= ($model->is_private) ? "Öffentlich machen" : "Privat stellen" ?>
                    </a>
                </td>
            </tr>
        </table>

        <div class="collapse" id="exifInformations">
            <div class="card card-body">
                <?php
                $exif_info = json_decode($model->exif_data);
                ?>

                <table class="table" style="width: 500px">
                    <tr><td>Original-Dateiname</td><td><?= Html::encode($exif_info->FileName) ?></td></tr>
                    <tr><td>Zeitpunkt der Erstellung</td><td><?= date("Y-m-d H:i:s", $exif_info->FileDateTime) ?></td></tr>
                    <tr><td>Dateigröße</td><td><?= round(($exif_info->FileSize * .0009765625) * .0009765625, 2) ?> MB</td></tr>
                    <tr><td>Dateityp</td><td><?= Html::encode($exif_info->MimeType) ?></td></tr>
                    <tr><td>Größe in Pixeln</td><td><?= explode("\"", $exif_info->COMPUTED->html)[1] ?>x<?= explode("\"", $exif_info->COMPUTED->html)[3] ?></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>