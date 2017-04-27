<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 * @property string $categorie
 *
 */
class ProductSearch extends Product
{
    public $categorie;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'categorie_id'], 'integer'],
            [['product', 'slug', 'description', 'image'], 'safe'],
            [['categorie'], 'string'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
//var_dump($params);die;
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('categorie');
        $dataProvider->sort->attributes['categorie'] = [
            'asc' => ['categorie.categorie' => SORT_ASC],
            'desc' => ['categorie.categorie' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'categorie_id' => $this->categorie_id,
        ]);

        $query->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'categorie.categorie', $this->categorie])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
