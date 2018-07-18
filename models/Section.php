<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "section".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_section_id
 * @property string $cover
 * @property string $description
 *
 * @property Catalog[] $catalogs
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'cover', 'description'], 'string'],
            [['parent_section_id', 'user_id'], 'required'],
            [['parent_section_id', 'created_at', 'updated_at', 'user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'parent_section_id' => 'Родительский раздел ID',
            'cover' => 'Обложка',
            'description' => 'Описание',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
            'user_id' => 'Пользователь',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogs()
    {
        return $this->hasMany(Catalog::className(), ['section_id' => 'id']);
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
