<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property int $id
 * @property string $place_name
 * @property string $description
 * @property string $images
 *
 * @property Catalog[] $catalogs
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['place_name', 'description', 'images'], 'string'],
            [['user_id'], 'required'],
            [['created_at', 'updated_at', 'user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'place_name' => 'Place Name',
            'description' => 'Description',
            'images' => 'Images',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogs()
    {
        return $this->hasMany(Catalog::className(), ['place_id' => 'id']);
    }
    
    public function saveModel($model)
    {
        if (!$model->created_at)
            $model->created_at = time();
        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;
        if ($model->save())
            return true;
    }
}
