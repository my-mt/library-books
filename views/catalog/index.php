<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Section;
use app\models\Format;
use app\models\Author;

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
            [
              'label' => 'Формат',
              'attribute' => 'format_view',
              'filter' => Format::find()->select(['format_str'])->indexBy('format_str')->column(),
              'value' => 'format.format_str',
            ],
            [
                'label' => 'Автор (соавторы)',
                'attribute' => 'author_view',
//                'filter' => Author::find()->select(['surname'])->indexBy('surname')->column(),
                'filter' => Author::find(),
                'format' => 'raw',
//                'value' => 'author.surname',
                'value' => function ($data) {
                $authors = explode(',', $data->joint_authors_id);
                $authors_list = '';
                $br = '';
                foreach ($authors as $k => $v) {
                $author = Author::findOne($v);
                $authors_list .= $br.$author['surname'];
//                $authors_list .= ' '.$author['name'];
                $br = '<br>';
                }
                return $authors_list;
                }
            ],
            'name:ntext',
//            'joint_authors_id',
//            'description:ntext',
//            'section_id',
            //'link_file:ntext',
            'year_made',
//            'year_writing',
//            'format_id',
//            'language',
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
