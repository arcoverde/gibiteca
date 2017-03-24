<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Volume;

/**
 * VolumeSearch represents the model behind the search form of `app\models\Volume`.
 */
class VolumeSearch extends Volume
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_volume', 'id_titulo', 'numero', 'data_mes', 'data_ano', 'avaliacao', 'foi_lido'], 'integer'],
            [['observacao'], 'safe'],
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
        $query = Volume::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
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
            'id_volume' => $this->id_volume,
            'id_titulo' => $this->id_titulo,
            'numero' => $this->numero,
            'data_mes' => $this->data_mes,
            'data_ano' => $this->data_ano,
            'avaliacao' => $this->avaliacao,
            'foi_lido' => $this->foi_lido,
        ]);

        $query->andFilterWhere(['like', 'observacao', $this->observacao]);
        $query->orderBy('numero DESC');

        return $dataProvider;
    }
}
