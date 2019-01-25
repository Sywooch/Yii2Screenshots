<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;

$this->title = 'Uploads';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?> (<?= ($stateOwn) ? "eigene" : "alle" ?>)</h1>
<?php
if(!Yii::$app->user->isGuest) {
    if(!$stateOwn) {
        ?><a class="btn btn-primary" href="<?= \yii\helpers\Url::to(["screen/uploaded", "own"=>true])?>">Nur meine Screenshots</a><?php
    } else {
        ?><a class="btn btn-primary" href="<?= \yii\helpers\Url::to(["screen/uploaded", "own"=>false])?>">Alle Screenshots anzeigen</a><?php
    }
}
?>
 <a class="btn btn-success" href="<?= \yii\helpers\Url::to(["screen/upload"])?>">Neuer Upload</a>
<hr>
<?php if(count($result) == 0) { ?>
    <p>
        Es wurden keine Screenshots hochgeladen
    </p>
<?php } else { ?>
    <table class="table">
        <tr>
            <th>Dateiname</th>
            <th>Hochgeladen von</th>
            <th>Zeitstempel</th>
            <th>Privatphäre</th>
        </tr>
        <?php
        foreach ($result as $item) {
            ?>
            <tr>
                <td><?= Html::a($item->file_id, ['/screen/show/', "id"=>$item->file_id]) ?> (<?= Html::a("Direkt", Yii::getAlias('@webUrl')."/uploads/".$item->file_id, ['class'=>'text-muted']) ?>)</td>
                <td><?= \app\models\Users::findOne($item->uploader)->username ?></td>
                <td><?= $item->uploaded_at ?></td>
                <td><?= ($item->is_private) ? "Privat" : "Öffentlich" ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php
}
?>
