<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'author_id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'section_id') ?>

    <?php // echo $form->field($model, 'link_file') ?>

    <?php // echo $form->field($model, 'year_made') ?>

    <?php // echo $form->field($model, 'year_writing') ?>

    <?php // echo $form->field($model, 'format_id') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'place_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'cover') ?>

    <?php // echo $form->field($model, 'images') ?>

    <?php // echo $form->field($model, 'quality') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
