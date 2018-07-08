<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "format".
 *
 * @property int $id
 * @property string $format_str
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id
 *
 * @property Catalog[] $catalogs
 */
class Format extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'format';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['format_str', 'user_id'], 'required'],
            [['created_at', 'updated_at', 'user_id'], 'integer'],
            [['format_str'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'format_str' => 'Format Str',
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
        return $this->hasMany(Catalog::className(), ['format_id' => 'id']);
    }
}
