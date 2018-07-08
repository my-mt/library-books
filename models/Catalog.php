<?php

namespace app\models;

use Yii;
use app\models\Author;
use app\models\Section;
use app\models\Format;
use app\models\Place;
use yii\helpers\ArrayHelper;

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
    public $authorArr;
    public $sectionArr;
    public $formatArr;
    public $placeArr;
    
    public $section_view;
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
            [['author_id', 'section_id', 'year_made', 'year_writing', 'quantity', 'place_id', 'user_id', 'quality', 'format_id'], 'integer'],
            [['language'], 'string', 'max' => 8],
            [['joint_authors_id'], 'string', 'max' => 255],
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
            'name' => 'Название',
            'author_id' => 'Author ID',
            'description' => 'Описание',
            'section_id' => 'Section ID',
            'link_file' => 'Ссылка',
            'year_made' => 'Год выпуска книги',
            'year_writing' => 'Год написания книги',
            'format_id' => 'Формат',
            'language' => 'Язык',
            'quantity' => 'Количество',
            'place_id' => 'Place ID',
            'user_id' => 'User ID',
            'cover' => 'Обложка',
            'images' => 'Изображения',
            'quality' => 'Качество',
            'joint_authors_id' => 'Соавторы',
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
    
    // получить авторов
    public function getAuthorArr()
    {
        $arr = Author::find()->orderBy('name')->all();
        $result = [];
        foreach ($arr as $v) {
            $result[$v->id] = $v->name . ' ' . $v->surname;
        }
        return $result;
    }
    
    // получить разделы
    public function getSectionArr()
    {
        $arr = Section::find()->orderBy('name')->all();
        $result = ArrayHelper::map($arr,'id','name');
        return $result;
    }
    
    // получить форматы
    public function getFormatArr()
    {
        $arr = Format::find()->orderBy('format_str')->all();
        $result = ArrayHelper::map($arr,'id','format_str');
        return $result;
    }
    
    // получить места
    public function getPlaceArr()
    {
        $arr = Place::find()->orderBy('place_name')->where(['user_id' => Yii::$app->user->id])->all();
        $result = ArrayHelper::map($arr,'id','place_name');
        return $result;
    }
    
    public function saveModel($model)
    {
        if (!$model->created_at)
            $model->created_at = time();
        if (!$model->joint_authors_id)
            $model->joint_authors_id = '';
        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;
        if ($model->save())
            return true;
    }
    

}
