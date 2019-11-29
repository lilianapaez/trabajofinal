<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedidoproducto;

/**
 * PedidoproductoSearch represents the model behind the search form of `app\models\Pedidoproducto`.
 */
class PedidoproductoSearch extends Pedidoproducto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nrodetalle', 'idpedido', 'cantidadproducto', 'idproducto'], 'integer'],
            [['preciopublico'], 'number'],
            [['codigo','descripcion'],'safe'],
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
        $query = Pedidoproducto::find()->joinWith('producto');

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
            'nrodetalle' => $this->nrodetalle,
            'idpedido' => $this->idpedido,
            'preciopublico' => $this->preciopublico,
            'cantidadproducto' => $this->cantidadproducto,
            'idproducto' => $this->idproducto,
        ]);

        $query->andFilterWhere(['like', 'producto.codigo', $this->codigo])
              ->andFilterWhere(['like', 'producto.descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
