<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Format */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="format-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'format_str')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
