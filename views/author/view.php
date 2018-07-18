<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\Author */

$this->title = $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'portrait:ntext',
            'name:ntext',
            'surname:ntext',
            'patronymic:ntext',
//            'date_start',
//            'place_start:ntext',
//            'date_end',
//            'place_end:ntext',
//            'biography:ntext',
//            'works:ntext',
//            'created_at',
//            'updated_at',
            [
            'label' => 'Пользователь',
            'format' => 'raw',
            'value' => User::getUserbyId($model->user_id)->email,
            ],
        ],
    ]) ?>

</div>
