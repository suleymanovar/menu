<?php

namespace app\controllers;

use Yii;
use app\models\Dish;
use app\models\Ingredient;
use app\models\Consist;
use app\models\DishSearch;
use app\models\ConsistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DishController implements the CRUD actions for Dish model.
 */
class DishController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Dish models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dish model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dish model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dish();
		$consist=new Consist();
	
		
        if (Yii::$app->request->post("Dish")) {
			$name=Yii::$app->request->post("Dish");
			$model->name=$name['name'];
			$model->date_create=date("Y-m-d H:i:s");
			$model->date_update=date("Y-m-d H:i:s");
			if( $model->save())
			{
				$post=Yii::$app->request->post("Consist");
				
				foreach ($post['ingr_id'] as $arr)
				{
					$consist=new Consist();
					$consist->dish_id=$model->id;
					$consist->ingr_id=$arr;
					$consist->date_create=date("Y-m-d H:i:s");
					$consist->date_update=date("Y-m-d H:i:s");
					$consist->save();
				}
			return $this->redirect(['view', 'id' => $model->id]);
			}
            
        }

       return $this->render('create', [
            'model' => $model,
			'consist' => $consist,
        ]);
    }

    /**
     * Updates an existing Dish model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		$con_new=new Consist();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
		$searchModel = new ConsistSearch();
		$searchModel->dish_id=$id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      
        return $this->render('update', [
            'model' => $model,
			'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'con_new'=>$con_new
        ]);
    }

    /**
     * Deletes an existing Dish model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionDeleteConsist($id)
    {
      Consist::find()->where(["id"=>$id])->one()->delete();

       
    }
    /**
     * Finds the Dish model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dish the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dish::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
