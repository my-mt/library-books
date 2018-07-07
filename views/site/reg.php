<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */
?>
<div class="main-reg">
    <div class="row">
        <div class="col-sm-4">
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'captcha')->widget(Captcha::className()) ?>


                <div class="form-group">
                    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div><!-- main-reg -->
