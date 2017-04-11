<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "local".
 *
 * @property string $id_local
 * @property string $descricao
 *
 * @property Volume[] $volumes
 */
class Local extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'local';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_local' => 'Id Local',
            'descricao' => 'Descrição',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolumes()
    {
        return $this->hasMany(Volume::className(), ['id_local' => 'id_local']);
    }
    
    public static function getDataList()
    {
        $models=Local::find()->orderBy('descricao')->all();
        return \yii\helpers\ArrayHelper::map($models, 'id_local', 'descricao');
    }    
}
