<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property string $name
 * @property int $author_id
 * @property string $description
 * @property int $section_id
 * @property string $link_file
 * @property int $year_made
 * @property int $year_writing
 * @property string $format
 * @property string $language
 * @property int $quantity
 * @property int $place_id
 * @property int $user_id
 * @property string $cover
 * @property string $images
 * @property int $quality
 *
 * @property Author $author
 * @property Place $place
 * @property Section $section
 * @property User $user
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'link_file', 'cover', 'images'], 'string'],
            [['author_id', 'section_id', 'quantity', 'place_id', 'user_id'], 'required'],
            [['author_id', 'section_id', 'year_made', 'year_writing', 'quantity', 'place_id', 'user_id', 'quality'], 'integer'],
            [['format'], 'string', 'max' => 16],
            [['language'], 'string', 'max' => 8],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'author_id' => 'Author ID',
            'description' => 'Description',
            'section_id' => 'Section ID',
            'link_file' => 'Link File',
            'year_made' => 'Year Made',
            'year_writing' => 'Year Writing',
            'format' => 'Format',
            'language' => 'Language',
            'quantity' => 'Quantity',
            'place_id' => 'Place ID',
            'user_id' => 'User ID',
            'cover' => 'Cover',
            'images' => 'Images',
            'quality' => 'Quality',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
