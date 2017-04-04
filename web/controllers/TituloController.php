<?php

namespace app\controllers;

use Yii;
use app\models\Titulo;
use app\models\TituloSearch;
use app\models\Tag;
use app\models\Genero;
use app\models\Editora;
use app\models\Volume;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\base\DynamicModel;
use yii\helpers\Url;

/**
 * TituloController implements the CRUD actions for Titulo model.
 */
class TituloController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Titulo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TituloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        #guarda a url para voltar quando gravar na tela de alterar
        Url::remember(Yii::$app->request->url);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Titulo model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Titulo();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                return $this->redirect('index');
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
            }        
        }
        else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }            
    }

    /**
     * Updates an existing Titulo model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                return $this->redirect('index');
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                #return \yii\widgets\ActiveForm::validate($model);
                return $this->redirect(Url::previous());
            }        
        }
        else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }            
    }

    /**
     * Deletes an existing Titulo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionTags($id)
    {
        $model = Tag::find()
            ->joinWith('titulos')
            ->where(['titulo_has_tag.id_titulo' => $id]);

        return $this->renderAjax('link_index', [
            'model' => new ActiveDataProvider(['query' => $model]),
            'titulo' => $this->findModel($id),
            'data_list' => Tag::getDataList(),
            'action_prefix' => 'tags',
        ]);
    }

    public function actionTagsLink($id_titulo, $id_link)
    {
        $titulo = $this->findModel($id_titulo);
        $tag = Tag::findOne($id_link);
        $titulo->link('tags', $tag);
        return \yii\helpers\Json::encode($tag);
    }

    public function actionTagsUnlink($id_titulo, $id_link)
    {
        $titulo = $this->findModel($id_titulo);
        $tag = Tag::findOne($id_link);
        $titulo->unlink('tags', $tag, true);
        return \yii\helpers\Json::encode(['success' => true]);    
    }

    public function actionGeneros($id)
    {
        $model = Genero::find()
            ->joinWith('titulos')
            ->where(['titulo_has_genero.id_titulo' => $id]);

        return $this->renderAjax('link_index', [
            'model' => new ActiveDataProvider(['query' => $model]),
            'titulo' => $this->findModel($id),
            'data_list' => Genero::getDataList(),
            'action_prefix' => 'generos',
        ]);
    }

    public function actionGenerosLink($id_titulo, $id_link)
    {
        $titulo = $this->findModel($id_titulo);
        $genero = Genero::findOne($id_link);
        $titulo->link('generos', $genero);
        return \yii\helpers\Json::encode($genero);
    }

    public function actionGenerosUnlink($id_titulo, $id_link)
    {
        $titulo = $this->findModel($id_titulo);
        $genero = Genero::findOne($id_link);
        $titulo->unlink('generos', $genero, true);
        return \yii\helpers\Json::encode(['success' => true]);
    }

    public function actionEditoras($id)
    {
        $model = Editora::find()
            ->joinWith('titulos')
            ->where(['titulo_has_editora.id_titulo' => $id]);

        return $this->renderAjax('link_index', [
            'model' => new ActiveDataProvider(['query' => $model]),
            'titulo' => $this->findModel($id),
            'data_list' => Editora::getDataList(),
            'action_prefix' => 'editoras',
        ]);
    }

    public function actionEditorasLink($id_titulo, $id_link)
    {
        $titulo = $this->findModel($id_titulo);
        $editora = Editora::findOne($id_link);
        $titulo->link('editoras', $editora);
        return \yii\helpers\Json::encode($editora);
    }

    public function actionEditorasUnlink($id_titulo, $id_link)
    {
        $titulo = $this->findModel($id_titulo);
        $editora = Editora::findOne($id_link);
        $titulo->unlink('editoras', $editora, true);
        return \yii\helpers\Json::encode(['success' => true]);
    }

    /**
     * Finds the Titulo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Titulo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Titulo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
