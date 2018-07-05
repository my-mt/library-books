<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $portrait
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $date_start
 * @property string $place_start
 * @property string $date_end
 * @property string $place_end
 * @property string $biography
 * @property string $works
 *
 * @property Catalog[] $catalogs
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['portrait', 'name', 'surname', 'patronymic', 'place_start', 'place_end', 'biography', 'works'], 'string'],
            [['date_start', 'date_end'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'portrait' => 'Portrait',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'date_start' => 'Date Start',
            'place_start' => 'Place Start',
            'date_end' => 'Date End',
            'place_end' => 'Place End',
            'biography' => 'Biography',
            'works' => 'Works',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogs()
    {
        return $this->hasMany(Catalog::className(), ['author_id' => 'id']);
    }
}
