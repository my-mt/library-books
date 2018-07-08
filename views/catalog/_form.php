<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Catalog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-form">

    <div class="row">
    <div class="col-sm-6">
        
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 1]) ?>
    
    <?= $form->field($model, 'author_id')->dropDownList($model->authorArr)->label('Автор');?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'section_id')->dropDownList($model->sectionArr)->label('Раздел');?>

    <?= $form->field($model, 'link_file')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'year_made')->textInput() ?>

    <?= $form->field($model, 'year_writing')->textInput() ?>
        
    </div>    
    
    <div class="col-sm-6">

    <?= $form->field($model, 'format_id')->dropDownList($model->formatArr)->label('Формат');?>

    <?= $form->field($model, 'language')->dropDownList(['RU' => 'Русский']) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'place_id')->dropDownList($model->placeArr)?>

    <?= $form->field($model, 'cover')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'images')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'quality')->dropDownList([5 => 5, 4 => 4, 3 => 3, 2 => 2 ]) ?>
    
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        
</div>
