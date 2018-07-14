<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Section;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catalogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Catalog', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
              'label' => 'Раздел',
              'attribute' => 'section_view',
              'filter' => Section::find()->select(['name'])->indexBy('name')->column(),
              'value' => 'section.name',
            ],
            'name:ntext',
            'joint_authors_id',
            'description:ntext',
            'section_id',
            //'link_file:ntext',
            //'year_made',
            //'year_writing',
            //'format_id',
            //'language',
            //'quantity',
            //'place_id',
            //'user_id',
            //'cover:ntext',
            //'images:ntext',
            //'quality',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
