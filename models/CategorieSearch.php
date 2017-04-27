<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Categorie;

/**
 * CategorieSearch represents the model behind the search form of `app\models\Categorie`.
 */
class CategorieSearch extends Categorie
{
    public $image;
    public $product;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id'], 'integer'],
            [['categorie', 'slug', 'image', 'product'], 'safe'],
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
        $query = Categorie::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('products');
        $dataProvider->sort->attributes['image'] = [
            'asc' => ['product.image' => SORT_ASC],
            'desc' => ['product.image' => SORT_DESC],
        ];
        $query->joinWith('products');
        $dataProvider->sort->attributes['product'] = [
            'asc' => ['product.product' => SORT_ASC],
            'desc' => ['product.product' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'categorie', $this->categorie])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'product.image', $this->image])
            ->andFilterWhere(['like', 'product.product', $this->product]);

        return $dataProvider;
    }
}
