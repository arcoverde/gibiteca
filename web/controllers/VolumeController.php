<?php

namespace app\controllers;

use Yii;
use app\models\Volume;
use app\models\VolumeSearch;
use app\models\Tag;
use app\models\Titulo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/**
 * VolumeController implements the CRUD actions for Volume model.
 */
class VolumeController extends Controller
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
     * Lists all Volume models.
     * @return mixed
     */
    public function actionIndex($id_titulo)
    {
        $searchModel = new VolumeSearch(['id_titulo' => $id_titulo]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        #guarda a url para voltar quando gravar na tela de alterar
        Url::remember(Yii::$app->request->url);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'titulo' => Titulo::findOne($id_titulo),
        ]);
    }

    /**
     * Creates a new Volume model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate($id_titulo)
    {
        $model = new Volume();
        $model->id_titulo = $id_titulo;
        $model->data_mes = date('m');
        $model->data_ano = date('Y');
        $model->avaliacao = 3;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($_FILES['Volume']['error']['foto'] == 0) {
                $model->foto = UploadedFile::getInstance($model, 'foto');
                $model->upload();
            }
            
            if (isset($_POST['adicionar'])) {
                Yii::$app->session->setFlash('success', 'Volume adicionado com sucesso.');
                return $this->redirect(['create', 'id_titulo' => $id_titulo]);
            } else {
                return $this->redirect(['index', 'id_titulo' => $id_titulo]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'titulo' => Titulo::findOne($id_titulo),
            ]);
        }
    }

    /**
     * Updates an existing Volume model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($_FILES['Volume']['error']['foto'] == 0) {
                $model->foto = UploadedFile::getInstance($model, 'foto');
                $model->upload();
            }
            //return $this->redirect(['index', 'id_titulo' => $model->id_titulo]);
            return $this->redirect(Url::previous());
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Volume model.
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
            ->joinWith('volumes')
            ->where(['volume_has_tag.id_volume' => $id]);

        return $this->renderAjax('link_index', [
            'model' => new ActiveDataProvider(['query' => $model]),
            'volume' => $this->findModel($id),
            'data_list' => Tag::getDataList(),
            'action_prefix' => 'tags',
        ]);
    }
    
    public function actionTagsLink($id_volume, $id_link)
    {
        $volume = $this->findModel($id_volume);
        $tag = Tag::findOne($id_link);
        $volume->link('tags', $tag);
        return \yii\helpers\Json::encode($tag);
    }

    public function actionTagsUnlink($id_volume, $id_link)
    {
        $volume = $this->findModel($id_volume);
        $tag = Tag::findOne($id_link);
        $volume->unlink('tags', $tag, true);
        return \yii\helpers\Json::encode(['success' => true]);
    }
   
    /**
     * Finds the Volume model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Volume the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Volume::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
