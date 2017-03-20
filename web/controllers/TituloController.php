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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Titulo model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Titulo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
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
     * If update is successful, the browser will be redirected to the 'view' page.
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

        return $this->renderAjax('tags_index', [
            'model' => new ActiveDataProvider(['query' => $model]),
            'titulo' => $this->findModel($id),
        ]);
    }

    public function actionTagsLink($id)
    {
        $model = new DynamicModel(['id_tag']);
        $model->addRule('id_tag', 'required');
        $model->addRule('id_tag', 'integer');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $titulo = $this->findModel($id);
            $tag = Tag::findOne($model->id_tag);
            $titulo->link('tags', $tag);
            
            return $this->redirect(['tags', 'id' => $id]);
            #Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            #return ['success' => true];
        }
        else {
            return $this->renderAjax('tags_link', [
                'model' => $model,
            ]);
        }
    }

    public function actionTagsUnlink($id_titulo, $id_tag)
    {
        $titulo = $this->findModel($id_titulo);
        $tag = Tag::findOne($id_tag);
        $titulo->unlink('tags', $tag, true);
        #return $this->redirect(['tags', 'id' => $id_titulo]);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['success' => true];
    }

    public function actionGeneros($id)
    {
        $model = Genero::find()
            ->joinWith('titulos')
            ->where(['titulo_has_genero.id_titulo' => $id]);

        return $this->render('generos_index', [
            'model' => new ActiveDataProvider(['query' => $model]),
            'titulo' => $this->findModel($id),
        ]);
    }

    public function actionGenerosLink($id)
    {
        $model = new DynamicModel(['id_genero']);
        $model->addRule(['id_genero'], 'integer');
        $model->addRule(['id_genero'], 'required');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $titulo = $this->findModel($id);
            $genero = Genero::findOne($model->id_genero);
            $titulo->link('generos', $genero);

            return $this->redirect(['generos', 'id' => $id]);
        } else {
            return $this->render('generos_link', [
                'model' => $model,
            ]);
        }
    }

    public function actionEditoras($id)
    {
        $model = Editora::find()
            ->joinWith('titulos')
            ->where(['titulo_has_editora.id_titulo' => $id]);

        return $this->render('editoras_index', [
            'model' => new ActiveDataProvider(['query' => $model]),
            'titulo' => $this->findModel($id),
        ]);
    }

    public function actionEditorasLink($id)
    {
        $model = new DynamicModel(['id_editora']);
        $model->addRule(['id_editora'], 'integer');
        $model->addRule(['id_editora'], 'required');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $titulo = $this->findModel($id);
            $editora = Editora::findOne($model->id_editora);
            $titulo->link('editoras', $editora);

            return $this->redirect(['editoras', 'id' => $id]);
        } else {
            return $this->render('editoras_link', [
                'model' => $model,
            ]);
        }
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
