<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Catalog;

/**
 * CatalogSearch represents the model behind the search form of `app\models\Catalog`.
 */
class CatalogSearch extends Catalog
{
    public $section;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'section_id', 'year_made', 'year_writing', 'quantity', 'place_id', 'user_id', 'quality', 'format_id'], 'integer'],
            [['name', 'description', 'link_file', 'language', 'cover', 'images', 'section_view', 'format_view', 'author_view', 'place_view'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Catalog::find();
        $query->joinWith('section');
        $query->joinWith('format');
        $query->joinWith('author');
        $query->joinWith('place');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['section_view'] = [
          'asc' => ['section.name' => SORT_ASC],
          'desc' => ['section.name' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['format_view'] = [
          'asc' => ['format.format_str' => SORT_ASC],
          'desc' => ['format.format_str' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['author_view'] = [
          'asc' => ['author.surname' => SORT_ASC],
          'desc' => ['author.surname' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['place_view'] = [
          'asc' => ['place.place_name' => SORT_ASC],
          'desc' => ['place.place_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
            'section_id' => $this->section_id,
            'year_made' => $this->year_made,
            'year_writing' => $this->year_writing,
            'quantity' => $this->quantity,
            'place_id' => $this->place_id,
            'user_id' => $this->user_id,
            'quality' => $this->quality,
        ]);

        $query->andFilterWhere(['like', 'catalog.name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'link_file', $this->link_file])
            ->andFilterWhere(['like', 'format_id', $this->format_id])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'cover', $this->cover])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'section.name', $this->section_view])
            ->andFilterWhere(['like', 'format.format_str', $this->format_view])
            ->andFilterWhere(['like', 'author.surname', $this->author_view])
            ->andFilterWhere(['like', 'place.place_name', $this->place_view]);

        return $dataProvider;
    }
}
