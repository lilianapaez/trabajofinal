<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form of `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    public $telefono1;
    public $telefono2;
    public $interno1;
    public $interno2;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idusuario', 'activado', 'idgenero', 'idtelefono', 'idprovincia', 'idciudad', 'idzona', 'idrol'], 'integer'],
            [['nombre', 'apellido', 'dni', 'direccion', 'nick', 'contrasenia', 'mailusuario', 'fechaalta', 'authkey','telefono1','telefono2','interno1','interno2'], 'safe'],
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
        $query = Usuario::find();

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
            'idusuario' => $this->idusuario,
            'fechaalta' => $this->fechaalta,
            'activado' => $this->activado,
            'idgenero' => $this->idgenero,
            'idtelefono' => $this->idtelefono,
            'idprovincia' => $this->idprovincia,
            'idciudad' => $this->idciudad,
            'idzona' => $this->idzona,
            'idrol' => $this->idrol,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'nick', $this->nick])
            ->andFilterWhere(['like', 'contrasenia', $this->contrasenia])
            ->andFilterWhere(['like', 'mailusuario', $this->mailusuario])
            ->andFilterWhere(['like', 'authkey', $this->authkey]);

        return $dataProvider;
    }

    public function usuarioZonaRol(){
        $query = new Query;
        $query 
    ->select(['*'])
    ->from('Usuario')
    ->groupBy(['idzona'])
    ->orderBy('idzona asc')
    ->all();
    
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    return $dataProvider;
    }
}
