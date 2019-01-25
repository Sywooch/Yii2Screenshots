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
        Benutzername: <?= $model->username ?><br>
        E-Mail Adresse: <?= $model->email ?><br>
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
            <b>Hinweis:</b> Das Bild wird hier als "privat" hochgeladen. Bei der Einstellung "privat" ist nur
            das teilen des direkten Bildes möglich. Sollen alle Nutzer dieser Platform das Bild sehen können,
            so setze das Bild auf "Öffentlich machen" im Bild.
        </p>
    </div>
    <div class="col-md-6">
        <b>Einstellungen zum Kopieren</b><br>
        <code>
            {<br>
            "Name": "<?= Yii::$app->name ?>",<br>
            "DestinationType": "ImageUploader, FileUploader",<br>
            "RequestURL": "<?= Yii::getAlias('@webUrl') ?>/share/upload-image",<br>
            "FileFormName": "upload_image",<br>
            "Arguments": {<br>
            "api_key": "<?= $model->api_key ?>"<br>
            },<br>
            "URL": "$json:url_direct$",<br>
            "ThumbnailURL": "$json:url_thumbnail$",<br>
            "DeletionURL": "$json:url_forcedelete$"<br>
            }
        </code>
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
        <a class="btn btn-success">Alle meine Inhalte öffentlich stellen</a> <a class="btn btn-warning">Alle meine Inhalte privat stellen</a>
        <h3>Inhalte entfernen</h3>
        <p>
            Alle deine bei uns hochgeladenen Bilder können mit einem Klick auf den Knopf entfernt werden.
            Diese Aktion kann nicht rückgängig gemacht werden.
        </p>
        <a class="btn btn-danger">Alle meine Inhalte entfernen</a>
    </div>
</div>