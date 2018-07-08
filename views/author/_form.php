<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Author */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="author-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'portrait')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'surname')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'patronymic')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'date_start')->textInput() ?>

    <?= $form->field($model, 'place_start')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'date_end')->textInput() ?>

    <?= $form->field($model, 'place_end')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'biography')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'works')->textarea(['rows' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
