<?php

namespace app\modules\admin\controllers;

use app\models\Apartments;
use app\models\ApartmentsType;
use app\models\HousesApartments;
use app\models\ResidentialComplexes;
use Yii;
use app\models\Houses;
use app\models\HousesSaerch;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HousesController implements the CRUD actions for Houses model.
 */
class HousesController extends Controller
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
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->is_admin === 1;
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays a single Houses model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $apartments = Apartments::getApartmentsInHouse($id);
        $pages = new Pagination(['totalCount' => count($apartments)]);
        $pages->setPageSize(12);
        $apartments = array_slice($apartments, $pages->offset, $pages->limit);

        return $this->render('view', [
            'model' => $model,
            'residence' => ResidentialComplexes::findOne($model->residential_com_id),
            'typeList' => ApartmentsType::getTypesArr(),
            'apartmentsList' => $apartments,
            "pages" => $pages
        ]);
    }

    public function actionCreate($rcId)
    {
        $newHouse = new Houses();
        $newHouse->residential_com_id = $rcId;

        if($newHouse->load( Yii::$app->request->post()) && $newHouse->validate())
        {
            $newHouse->save();
        }
        return $this->redirect(['default/view', 'id' =>  $rcId]);
    }
    /**
     * Updates an existing Houses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Houses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Houses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Houses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Houses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
