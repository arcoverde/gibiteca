<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "titulo_has_genero".
 *
 * @property string $id_titulo
 * @property string $id_genero
 *
 * @property Genero $genero
 * @property Titulo $titulo
 */
class TituloHasGenero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'titulo_has_genero';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_titulo', 'id_genero'], 'required'],
            [['id_titulo', 'id_genero'], 'integer'],
            [['id_genero'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['id_genero' => 'id_genero']],
            [['id_titulo'], 'exist', 'skipOnError' => true, 'targetClass' => Titulo::className(), 'targetAttribute' => ['id_titulo' => 'id_titulo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_titulo' => 'Id Titulo',
            'id_genero' => 'Id Genero',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Genero::className(), ['id_genero' => 'id_genero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitulo()
    {
        return $this->hasOne(Titulo::className(), ['id_titulo' => 'id_titulo']);
    }
}
