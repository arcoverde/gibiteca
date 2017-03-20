<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "editora".
 *
 * @property string $id_editora
 * @property string $nome
 *
 * @property TituloHasEditora[] $tituloHasEditoras
 * @property Titulo[] $titulos
 */
class Editora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'editora';
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
            'id_editora' => 'Id Editora',
            'nome' => 'Nome',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTituloHasEditoras()
    {
        return $this->hasMany(TituloHasEditora::className(), ['id_editora' => 'id_editora']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitulos()
    {
        return $this->hasMany(Titulo::className(), ['id_titulo' => 'id_titulo'])->viaTable('titulo_has_editora', ['id_editora' => 'id_editora']);
    }

    public static function getDataList()
    {
        $models=Editora::find()->orderBy('nome')->all();
        return \yii\helpers\ArrayHelper::map($models, 'id_editora', 'nome');
    }    
}
