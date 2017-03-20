<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property string $id_tag
 * @property string $nome
 *
 * @property TituloHasTag[] $tituloHasTags
 * @property Titulo[] $titulos
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
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
            'id_tag' => 'Id Tag',
            'nome' => 'Nome',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTituloHasTags()
    {
        return $this->hasMany(TituloHasTag::className(), ['id_tag' => 'id_tag']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitulos()
    {
        return $this->hasMany(Titulo::className(), ['id_titulo' => 'id_titulo'])->viaTable('titulo_has_tag', ['id_tag' => 'id_tag']);
    }

    public static function getDataList()
    {
        $models=Tag::find()->orderBy('nome')->all();
        return \yii\helpers\ArrayHelper::map($models, 'id_tag', 'nome');
    }    
}
