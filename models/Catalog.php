<?php

namespace app\models;

use Yii;
use app\models\Author;
use app\models\Section;
use app\models\Format;
use app\models\Place;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\imagine\Image;

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
    
    public $cover_file;// переменная для загрузки фотографии
    
    public $section_view;
    public $format_view;
    public $author_view;
    public $user_view;
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
            [['section_id', 'quantity', 'place_id', 'user_id'], 'required'],
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
            'joint_authors_id' => 'Автор(ы)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'joint_authors_id']);
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
    
    public function getFormat()
    {
        return $this->hasOne(Format::className(), ['id' => 'format_id']);
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
    
    public function beforeSave($insert)
    {   
        if ($insert) {
            $this->created_at = time();
        }
        $this->updated_at = time();
        return true;
    }
    
    public function saveCover()
    {
        if ($this->cover) $this->deleteImg($this->cover);
        $dir_photo = Yii::$app->params['dir_img_book']; // создаем путь
        $name_photo = $this->id . '-' . time() . '.' . $this->cover_file->extension; // имя и расширение
        $this->cover_file->saveAs($dir_photo . $name_photo); // сохраняем файл (изображение)
        $this->cover = $name_photo; //пишем в модель имя изобр.
        $this->cover_file = null;
        $this->save(); // сохраняем модель, в том числе и имя изображения

        $size = getimagesize($dir_photo . $name_photo); //получаем размер загруженного изображения [0]-ширина изображения [1] - высота изображения
        $factor = 4; //коэф уменьшения исходного изображения
        $width_img = (int) ($size[0] / $factor);
        $height_img = (int) ($size[1] / $factor);

        // сохраняем миниатюру
        Image::thumbnail($dir_photo . $name_photo, $width_img, $height_img)
                ->save(Yii::getAlias($dir_photo . 'thumbnail/' . $name_photo), ['quality' => 80]);
    }
    
    public function deleteImg($name)
    {
        if (file_exists(Yii::$app->params['dir_img_book'] . $name))
            unlink(Yii::$app->params['dir_img_book'] . $name); // удаляем фото
        if (file_exists(Yii::$app->params['dir_img_book'] . 'thumbnail/' . $name))
            unlink(Yii::$app->params['dir_img_book'] . 'thumbnail/' . $name); // удаляем миниатюру
    }
    
    // получить список авторов
    public function getJointAuthorsList () {
        $result = '';
        $authorArr = $this->getAuthorArr();
        $joint_authors_id_cat = explode(',', $this->joint_authors_id);
        $br = '';
        foreach ($joint_authors_id_cat as $k => $v) {
            if (!$v) continue;
            $result  .= $br.$authorArr[$v];
            $br = '<br>';
        }
        
        return $result;
    }
    
    // получить название раздела
    public function getSectionName()
    {
        $section = Section::findOne($this->section_id);
        $result = $section->name;
        return $result;
    }

    // получить название формата
    public function getFormatName()
    {
        $format = Format::findOne($this->format_id);
        $result = $format->format_str;
        return $result;
    }

    // получить имя пользователя
    public function getUserName()
    {
        $user = User::findOne($this->user_id);
        $result = $user->email;
        return $result;
    }

//    echo '<pre>';
//    print_r($this);
//    echo '</pre>';
//    exit;

}
