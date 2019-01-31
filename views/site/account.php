<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
$this->title = 'Mein Account';

$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
    Auf dieser Seite findest du alle nötigen Informationen und Werkzeuge um dein Account zu verwalten.
    Du hast die Möglichkeit alle deine Bilder zu entfernen, API-Zugänge zu verwalten und deine Kontoeinstellungen
    anzupassen. Bei Fragen/Problemen zögere nicht und wende dich einfach an den Seitenbetreiber.
</p>

<h2>Meine Kontodaten</h2>
<div class="row">
    <div class="col-md-12">
        Benutzername: <?= Html::encode($model->username) ?><br>
        E-Mail Adresse: <?= Html::encode($model->email) ?><br>
        Erstellt am: <?= $model->created_date ?><br>

        <h3>API Schlüssel</h3>
        Aktueller API-Schlüssel: <?= $model->api_key ?><br>
        <?= Html::a("Neuen API-Schlüssel bekommen", ["/site/account-api-reset"]) ?> (Vorhandener Schlüssel wird ungültig!)
    </div>
</div>

<h2>Hochladen mit ShareX</h2>
<div class="row">
    <div class="col-md-6">
        <p>
            Um Screenshots mit ShareX hochladen zu können, musst du ein wenig Konfigurationsarbeit leisten.<br>
            <ol>
                <li>Kopiere dir dir die Einstellungen in die Zwischenablage</li>
                <li>Öffne ShareX, klicke im linken Menü auf "Ziele" und dann auf "Zieleinstellungen"</li>
                <li>Scrolle im linken Menü nach ganz unten und klicke auf "Eigener Hochlader"</li>
                <li>Klicke auf "Importieren" und dann auf "Aus Zwischenablage"</li>
            </ol>
            Wenn du alle Schritte korrekt befolgt hast, ist der Upload von Screenshots ab nun an möglich!
            Jedes mal wenn du nun einen Screenshot erstellst wird dieser bei uns hochgeladen.
            <br><br>
            <b>Hinweis:</b> Das Bild wird hier als "öffentlich" hochgeladen. Solltest du dies ändern wollen,
            musst du in den Zieleinstellungen das Feld "upload_private" auf "true" setzen!
        </p>
    </div>
    <div class="col-md-6">
        <b>Einstellungen zum Kopieren</b><br>
        <input id="settingsText" value='{"Name": "<?= Yii::$app->name ?>","DestinationType": "ImageUploader, FileUploader", "RequestURL": "<?= Yii::getAlias('@webUrl') ?>/share/upload-image","FileFormName": "upload_image","Arguments": {"api_key": "<?= $model->api_key ?>", "upload_private": "false"},"URL": "$json:url_direct$","ThumbnailURL": "$json:url_thumbnail$","DeletionURL": "$json:url_forcedelete$"}'
        class="form-control">
        <div class="btn btn-info btn-xs clipboardButton" data-clipboard-target="#settingsText">In die Zwischenablage kopieren</div>
    </div>
</div>

<h2>Werkzeuge</h2>
<div class="row">
    <div class="col-md-6">
        <p>
            Diese Sektion ist nicht für den Regelgebraucht gedacht, überlege wirklich gut ob du die hier stehenden
            Werkzeuge verwenden möchtest. Einige Optionen können auch deine Inhalte verändern oder löschen.
        </p>
        <h3>Privatsphäre</h3>
        <p>
            Hier kannst du die Privatsphäre aller deiner hochgeladenen Bilder mit einem Klick ändern.
            Entweder stellst du alle Bilder auf "Privat" oder auf "Öffentlich".
        </p>
        <a class="btn btn-success" href="<?= \yii\helpers\Url::to(['site/account-privacy-mass', 'private'=>false])?>">Alle meine Inhalte öffentlich stellen</a> <a class="btn btn-warning" href="<?= \yii\helpers\Url::to(['site/account-privacy-mass', 'private'=>true])?>">Alle meine Inhalte privat stellen</a>
        <h3>Inhalte entfernen</h3>
        <p>
            Alle deine bei uns hochgeladenen Bilder können mit einem Klick auf den Knopf entfernt werden.
            Diese Aktion kann nicht rückgängig gemacht werden.
        </p>
        <a class="btn btn-danger" href="<?= \yii\helpers\Url::to(['site/account-delete-content'])?>">Alle meine Inhalte entfernen</a>
    </div>
</div>