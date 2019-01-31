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
Hochgeladene Screenshots: <?= count($user->screenshots); ?>

<h2>Veröffentlicht</h2>
<?php if(count($user->getScreenshotPublic()) == 0) { ?>
    <p>
        Keine veröffentlichten Screenshots vorhanden!
    </p>
<?php } else { ?>
    <div class="row">
        <?php
        foreach($user->getScreenshotPublic() as $upload) {
                ?>
                <div class="col-md-2">
                    <a class="thumbnail" href="<?= \yii\helpers\Url::to(["/s/".$upload->file_id])?>">
                        <img src="<?= \app\models\Screenshots::getImageUrl($upload->file_id) ?>" class="portrait">
                    </a>
                </div>
                <?php
        }
        ?>
    </div>
<?php } ?>
