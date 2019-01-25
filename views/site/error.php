<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <b>OH NEIN! Es kam leider zu einem Fehler.</b>
    </p>
    <p>
        Keine Sorge, wir haben ein Kellerkind mit der Beseitigung beauftragt!
    </p>

</div>
