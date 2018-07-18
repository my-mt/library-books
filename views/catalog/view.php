<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Author;

/* @var $this yii\web\View */
/* @var $model app\models\Catalog */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-view">

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
            'name:ntext',
            [
            'label' => 'Автор(ы)',
            'format' => 'raw',
            'value' => $model->author_view,
            ],
            [
            'label' => 'Обложка',
            'format' => 'raw',
            'value' => '<img class="img-thumbnail" src="' . Yii::$app->params['dir_img_book'] . $model->cover . '">',
            ],
            [
            'label' => 'Раздел',
            'format' => 'raw',
            'value' => $model->section_view,
            ],
            [
            'label' => 'Ссылка',
            'format' => 'raw',
            'value' => function ($model) {
                if ($model->link_file) {
                    return '<a target="_blank" href="'.$model->link_file.'">'.$model->link_file.'</a>';
                } else {
                    return '---';
                }
            }
            ],
            [
            'label' => 'Формат',
            'format' => 'raw',
            'value' => $model->format_view,
            ],
            'year_made',
            'year_writing',
            'quantity',
            'description:ntext',
            [
            'label' => 'Пользователь',
            'format' => 'raw',
            'value' => $model->user_view,
            ],
        ],
    ]) ?>

</div>
