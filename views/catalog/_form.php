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

    <?= Html::activeHiddenInput($model, 'joint_authors_id'); ?>
        
    <div class="form-group">
    <label>Автор(ы) <span id="list-author-delete" class="glyphicon glyphicon-minus-sign"></span></label>
    <div id="list-author">
        <?php
        $joint_authors_id_cat = explode(',', $model->joint_authors_id);
        $br = '';
        foreach ($joint_authors_id_cat as $k => $v) {
            if (!$v) continue;
            echo $br.$model->authorArr[$v];
            $br = '<br>';
        }
        ?>
    </div>
    <select class="form-control" id="select-author-id">
        <option value="0">---</option>
        <?php
        foreach ($model->authorArr as $k => $v) {
            echo "<option value='{$k}'>{$v}</option>";
        }
        ?>
    </select>
    </div>

    


    <div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'section_id')->dropDownList($model->sectionArr)->label('Раздел');?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'link_file')->textarea(['rows' => 1]) ?>
    </div>

     

    <div class="col-sm-6">
        <?= $form->field($model, 'year_made')->textInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'year_writing')->textInput() ?>
    </div>
    
        
    <div class="col-sm-6">
        <?= $form->field($model, 'format_id')->dropDownList($model->formatArr)->label('Формат');?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'quantity')->textInput() ?>
    </div>
        
    </div>
    </div>    
    
    <div class="col-sm-6">
    <div class="row">
    <div class="col-sm-6">    
        <?= $form->field($model, 'cover_file')->fileInput() ?>
        <img class="img-thumbnail" src="<?= Yii::$app->params['dir_img_book'].'thumbnail/'.$model->cover ?>"> 
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'place_id')->dropDownList($model->placeArr)->label('Место');?>
    </div>
    </div>
        <?= $form->field($model, 'description')->textarea(['rows' => 9]) ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        
</div>

<script>
    

    
    $( "#select-author-id" ).change(function () {
        var nameAuthor = "";
        var strId = "";
        $( "#select-author-id option:selected" ).each(function() {
            strId += $( this ).val();
            nameAuthor += $( this ).text();
        });
        var comma = '';
        var br = '';
        if ($( "#catalog-joint_authors_id" ).val().length > 0 && $( this ).val() != '0') {
            comma = ',';
            br = '<br>';
        }

        if ($( this ).val() != '0') {
            strId = $( "#catalog-joint_authors_id" ).val() + comma + strId;
            nameAuthor = $( "#list-author" ).html() + br + nameAuthor;
            $( "#catalog-joint_authors_id" ).val( strId );
            $( "#list-author" ).html( nameAuthor );
        }
    });
    
    $( "#list-author-delete" ).click(function () {
        $( "#catalog-joint_authors_id" ).val('');
        $( "#list-author" ).text('');
    });
</script>
