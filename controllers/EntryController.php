<?php

namespace app\controllers;

use Yii;
use app\models\Entry;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * EntryController implements the CRUD actions for Entry model.
 */
class EntryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Entry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Entry::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Entry model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Entry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Entry();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Creates a new entry
     * takes the ID of the tool, whose form to create
      */
    public function actionEntry($tool)
    {
      $model = new Entry(); //rand(100,999).substr(time(),-7
      if($_POST) {
        $entryid=time();
        foreach($_POST['d'] as $entry=>$value) {

            $en=new Entry();
            $en->attributes=[
              'entry'       =>$entryid,
              'form'        =>$entry,
              'subject'     =>$_POST['subject'],
              'subject_id'  =>$_POST['subject_id'],
              'score'       =>$value,
              'ref'         =>$_POST['ref'],
              'ref_id'      =>$_POST['ref_id']
            ];
          //  echo "<pre>";
          //  print_r($_POST); echo $entryid;
          //  print_r($en->attributes);
        //    exit;
        $en->save() or die(print_r($en->getErrors()));
        }
      }
      $dataset=Yii::$app->db->createCommand("SELECT * FROM `v_form` WHERE tool_id=".$tool." ORDER by category_name, ordering ASC")->queryAll();
      return $this->render('entry',['model' => $model,'dataset'=>$dataset]);
    }

    /**
     * Updates an existing Entry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Entry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Entry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Entry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Entry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
