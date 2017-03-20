<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genero".
 *
 * @property string $id_genero
 * @property string $nome
 *
 * @property TituloHasGenero[] $tituloHasGeneros
 * @property Titulo[] $titulos
 */
class Genero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genero';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['nome'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_genero' => 'Id Genero',
            'nome' => 'Nome',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTituloHasGeneros()
    {
        return $this->hasMany(TituloHasGenero::className(), ['id_genero' => 'id_genero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitulos()
    {
        return $this->hasMany(Titulo::className(), ['id_titulo' => 'id_titulo'])->viaTable('titulo_has_genero', ['id_genero' => 'id_genero']);
    }

    public static function getDataList()
    {
        $models=Genero::find()->orderBy('nome')->all();
        return \yii\helpers\ArrayHelper::map($models, 'id_genero', 'nome');
    }    
}
