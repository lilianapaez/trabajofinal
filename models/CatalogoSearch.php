<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Catalogo;

/**
 * CatalogoSearch represents the model behind the search form of `app\models\Catalogo`.
 */
class CatalogoSearch extends Catalogo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcatalogo', 'numeropagecat', 'idmarca', 'idcategoria'], 'integer'],
            [['imagencatalogo', 'campania', 'fechadesde', 'fechahasta', 'vigente'], 'safe'],
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
        $query = Catalogo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idcatalogo' => $this->idcatalogo,
            'fechadesde' => $this->fechadesde,
            'fechahasta' => $this->fechahasta,
            'numeropagecat' => $this->numeropagecat,
            'idmarca' => $this->idmarca,
            'idcategoria' => $this->idcategoria,
        ]);

        $query->andFilterWhere(['like', 'imagencatalogo', $this->imagencatalogo])
            ->andFilterWhere(['like', 'campania', $this->campania])
            ->andFilterWhere(['like', 'vigente', $this->vigente]);

        return $dataProvider;
    }
}
