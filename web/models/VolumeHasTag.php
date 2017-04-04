<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "volume_has_tag".
 *
 * @property string $id_volume
 * @property string $id_tag
 *
 * @property Tag $tag
 * @property Volume $volume
 */
class VolumeHasTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'volume_has_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_volume', 'id_tag'], 'required'],
            [['id_volume', 'id_tag'], 'integer'],
            [['id_tag'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['id_tag' => 'id_tag']],
            [['id_volume'], 'exist', 'skipOnError' => true, 'targetClass' => Volume::className(), 'targetAttribute' => ['id_volume' => 'id_volume']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_volume' => 'Id Volume',
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
    public function getVolume()
    {
        return $this->hasOne(Volume::className(), ['id_volume' => 'id_volume']);
    }
}
