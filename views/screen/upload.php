<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Neuer Upload';
$this->params['breadcrumbs'][] = ['label' => 'Uploads', 'url'=>['screen/uploaded']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Hochladen</h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'fileInput')->fileInput() ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= $form->field($model, 'is_private')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Jetzt hochladen', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>