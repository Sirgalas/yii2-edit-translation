<?php

namespace Sirgalas\yii2_edit_translation\controllers;

use Yii;
use Sirgalas\yii2_edit_translation\Transliter;
use Sirgalas\yii2_edit_translation\Massagesmodules;
use Sirgalas\yii2_edit_translation\TransliterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


/**
 * SourcemessageController implements the CRUD actions for SourceMessage model.
 */
class TransliterController extends Controller
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
     * Lists all SourceMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransliterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->request->post('hasEditable')) {
            $id = Yii::$app->request->post('editableKey');
            $editableAttribute= Yii::$app->request->post('editableAttribute');
            if($editableAttribute!='translation'&&$editableAttribute!='language') {
                $model = Transliter::findOne($id);
                $posted = current($_POST['Transliter']);
                $post = ['Transliter' => $posted];
            }else{
                $model = Massagesmodules::findOne(['id'=>$id]);
                $posted = current($_POST['Transliter']);
                $post = ['Massagesmodules' => $posted];
                $language=$model->language;
                $id=$model->id;
                $translation=$model->translation;
                $model->delete();
                $model= new Massagesmodules([
                    'id'           =>   $id,
                    'language'     =>   $language,
                    'translation'  =>   $translation
                ]);
            }
            $out = Json::encode(['output'=>'', 'message'=>'']);
            if ($model->load($post)) {
                $model->$editableAttribute=$posted[$editableAttribute];
                $model->save();
                $output = '';
                $out = Json::encode(['output'=>$output, 'message'=>'']);
            }else{
                return var_dump($model->getErrors());
            }
            echo $out;
            return ;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SourceMessage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SourceMessage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transliter();

        if ($model->load(Yii::$app->request->post())) {
            $post=Yii::$app->request->post('Transliter');
            $model->category=$post['category'];
            $model->message=$post['message'];
            $model->save();
            $language=$post['language'];
            $translation=$post['translation'];
            $model->saveMassage($model->id,$language,$translation);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SourceMessage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->save();
            $post=Yii::$app->request->post('Transliter');
            $model->category=$post['category'];
            $language=$post['language'];
            $translation=$post['translation'];
            $model->updateMassage($model->id,$language,$translation);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SourceMessage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SourceMessage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transliter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transliter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
