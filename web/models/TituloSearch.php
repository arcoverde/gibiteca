<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Titulo;

/**
 * TituloSearch represents the model behind the search form of `app\models\Titulo`.
 */
class TituloSearch extends Titulo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_titulo', 'id_categoria'], 'integer'],
            [['nome_titulo', 'nome_subtitulo'], 'safe'],
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
        $query = Titulo::find();

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
            'id_titulo' => $this->id_titulo,
            'id_categoria' => $this->id_categoria,
        ]);

        $query->andFilterWhere(['like', 'nome_titulo', $this->nome_titulo])
            ->andFilterWhere(['like', 'nome_subtitulo', $this->nome_subtitulo]);

        return $dataProvider;
    }
}
