<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Imagepageproducto;

/**
 * ImagepageproductoSearch represents the model behind the search form of `app\models\Imagepageproducto`.
 */
class ImagepageproductoSearch extends Imagepageproducto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idimagepage', 'idproducto'], 'integer'],
            [['preciopublico'], 'number'],
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
        $query = Imagepageproducto::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'idimagepage' => $this->idimagepage,
            'idproducto' => $this->idproducto,
            'preciopublico' => $this->preciopublico,
        ]);

        return $dataProvider;
    }
}
