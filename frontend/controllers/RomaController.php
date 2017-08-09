<?php

namespace frontend\controllers;

use backend\models\Brand;
use backend\models\Category;
use Yii;
use backend\models\Goods;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RomaController implements the CRUD actions for Goods model.
 */
class RomaController extends Controller
{
    public $layout='one';
    /**
     * @inheritdoc
     */
    /*public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Goods::find()->joinWith('brand')->joinWith('cate'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
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
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $brand=Brand::find()->asArray()->all();
            if ($brand && is_array($brand)) {
                foreach ($brand as $k => $v) {
                    $list1[$v['id']] = $v['bname'];
                }
            }
            $category=Category::find()->orderBy('path')->asArray()->all();
            if ($category && is_array($category)) {
                foreach ($category as $val) {
                    $space = count(explode(',', $val['path']));
                    /*$val['catename'] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $space) . $val['catename'];*/
                    $val['catename'] = str_repeat("--", $space) . $val['catename'];
                    $list2[$val['id']] = $val['catename'];
                }
            }
            return $this->render('create', [
                'model' => $model,
                'brand'=>$list1,
                'category'=>$list2,
                'list'=>$brand
            ]);
        }
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $category=Category::find()->asArray()->all();
            if ($category && is_array($category)) {
                foreach ($category as $key => $value) {
                    if ($value['id'] && $value['catename']) {
                        $category[$value['id']] = $value['catename'];
                    }
                }
            }

            return $this->render('update', [
                'model' => $model,
                'category'=>$category
            ]);
        }
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
