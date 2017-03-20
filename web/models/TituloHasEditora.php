<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "titulo_has_editora".
 *
 * @property string $id_titulo
 * @property string $id_editora
 *
 * @property Editora $editora
 * @property Titulo $titulo
 */
class TituloHasEditora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'titulo_has_editora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_titulo', 'id_editora'], 'required'],
            [['id_titulo', 'id_editora'], 'integer'],
            [['id_editora'], 'exist', 'skipOnError' => true, 'targetClass' => Editora::className(), 'targetAttribute' => ['id_editora' => 'id_editora']],
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
            'id_editora' => 'Id Editora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEditora()
    {
        return $this->hasOne(Editora::className(), ['id_editora' => 'id_editora']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitulo()
    {
        return $this->hasOne(Titulo::className(), ['id_titulo' => 'id_titulo']);
    }
}
