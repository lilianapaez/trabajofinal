<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;

/**
 * PedidoSearch represents the model behind the search form of `app\models\Pedido`.
 */
class PedidoSearch extends Pedido
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idpedido', 'idvendedor', 'idcatalogo'], 'integer'],
            [['nombrecomprador', 'telcelcomprador', 'fechapedido'], 'safe'],
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
        $query = Pedido::find();

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
            'idpedido' => $this->idpedido,
            'fechapedido' => $this->fechapedido,
            'idvendedor' => $this->idvendedor,
            'idcatalogo' => $this->idcatalogo,
        ]);

        $query->andFilterWhere(['like', 'nombrecomprador', $this->nombrecomprador])
            ->andFilterWhere(['like', 'telcelcomprador', $this->telcelcomprador]);

        return $dataProvider;
    }
}
