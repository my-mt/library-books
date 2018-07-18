<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Section */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="section-form">
    <div class="row">
        <div class="col-sm-4">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textarea(['rows' => 3]) ?>

            <?= $form->field($model, 'parent_section_id')->textInput() ?>

            <?php // echo $form->field($model, 'cover')->textarea(['rows' => 6]) ?>

            <?php // echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
