<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Author */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="author-form">
    <div class="row">
        <div class="col-sm-4">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->input(['rows' => 1]) ?>

            <?= $form->field($model, 'surname')->input(['rows' => 1]) ?>

            <?= $form->field($model, 'patronymic')->input(['rows' => 1]) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
