<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "titulo".
 *
 * @property string $id_titulo
 * @property string $id_categoria
 * @property string $nome_titulo
 * @property string $nome_subtitulo
 *
 * @property Categoria $categoria
 * @property TituloHasEditora[] $tituloHasEditoras
 * @property Editora[] $editoras
 * @property TituloHasGenero[] $tituloHasGeneros
 * @property Genero[] $generos
 * @property TituloHasTag[] $tituloHasTags
 * @property Tag[] $tags
 * @property Volume[] $volumes
 */
class Titulo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'titulo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_categoria', 'nome_titulo'], 'required'],
            [['id_categoria'], 'integer'],
            [['nome_titulo', 'nome_subtitulo'], 'string', 'max' => 100],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['id_categoria' => 'id_categoria']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_titulo' => 'Id Titulo',
            'id_categoria' => 'Categoria',
            'nome_titulo' => 'Título',
            'nome_subtitulo' => 'Subtítulo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id_categoria' => 'id_categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTituloHasEditoras()
    {
        return $this->hasMany(TituloHasEditora::className(), ['id_titulo' => 'id_titulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEditoras()
    {
        return $this->hasMany(Editora::className(), ['id_editora' => 'id_editora'])->viaTable('titulo_has_editora', ['id_titulo' => 'id_titulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTituloHasGeneros()
    {
        return $this->hasMany(TituloHasGenero::className(), ['id_titulo' => 'id_titulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneros()
    {
        return $this->hasMany(Genero::className(), ['id_genero' => 'id_genero'])->viaTable('titulo_has_genero', ['id_titulo' => 'id_titulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTituloHasTags()
    {
        return $this->hasMany(TituloHasTag::className(), ['id_titulo' => 'id_titulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id_tag' => 'id_tag'])->viaTable('titulo_has_tag', ['id_titulo' => 'id_titulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolumes()
    {
        return $this->hasMany(Volume::className(), ['id_titulo' => 'id_titulo']);
    }
    
    public function getQtdVolumes()
    {
        return count($this->volumes);
    }
    
    public function getPeriodo()
    {
        if (count($this->volumes) > 0) {
            $ano_ini = $this->volumes[0]->data_ano;
            $ano_fim = $this->volumes[count($this->volumes)-1]->data_ano;
            return $ano_ini == $ano_fim ? $ano_ini : $ano_ini . ' - ' . $ano_fim;
        } else {
            return null;
        }
    }
}
