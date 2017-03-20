<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "titulo_has_tag".
 *
 * @property string $id_titulo
 * @property string $id_tag
 *
 * @property Tag $tag
 * @property Titulo $titulo
 */
class TituloHasTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'titulo_has_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_titulo', 'id_tag'], 'required'],
            [['id_titulo', 'id_tag'], 'integer'],
            [['id_tag'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['id_tag' => 'id_tag']],
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
            'id_tag' => 'Id Tag',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id_tag' => 'id_tag']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitulo()
    {
        return $this->hasOne(Titulo::className(), ['id_titulo' => 'id_titulo']);
    }
}
