<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "volume".
 *
 * @property string $id_volume
 * @property string $id_titulo
 * @property string $id_local
 * @property int $numero
 * @property int $data_mes
 * @property int $data_ano
 * @property int $avaliacao
 * @property int $foi_lido
 * @property string $observacao
 *
 * @property Local $local
 * @property Titulo $titulo
 * @property VolumeHasTag[] $volumeHasTags
 * @property Tag[] $tags
 */
class Volume extends \yii\db\ActiveRecord
{
    public $foto;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'volume';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['foto'], 'file', 'extensions' => 'jpg'],
            [['id_titulo'], 'required'],
            [['id_titulo', 'id_local', 'numero', 'data_mes', 'data_ano', 'avaliacao', 'foi_lido'], 'integer'],
            [['observacao'], 'string', 'max' => 100],
            [['id_titulo'], 'exist', 'skipOnError' => true, 'targetClass' => Titulo::className(), 'targetAttribute' => ['id_titulo' => 'id_titulo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_volume' => 'Id Volume',
            'id_titulo' => 'Id Titulo',
            'id_local' => 'Local',
            'numero' => 'Número',
            'data_mes' => 'Mês',
            'data_ano' => 'Ano',
            'avaliacao' => 'Avaliação',
            'foi_lido' => 'Lido',
            'observacao' => 'Observação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocal()
    {
        return $this->hasOne(Local::className(), ['id_local' => 'id_local']);
    }    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolumeHasTags()
    {
        return $this->hasMany(VolumeHasTag::className(), ['id_volume' => 'id_volume']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id_tag' => 'id_tag'])->viaTable('volume_has_tag', ['id_volume' => 'id_volume']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitulo()
    {
        return $this->hasOne(Titulo::className(), ['id_titulo' => 'id_titulo']);
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->foto->saveAs('upload/capas/' . $this->id_volume . '.jpg');
            return true;
        }
        else {
            return false;
        }
    }
}
