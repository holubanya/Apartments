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
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $newApartment = new Apartments();
        $apartments = Apartments::getApartmentsInHouse($id);
        $pages = new Pagination(['totalCount' => count($apartments)]);
        $pages->setPageSize(12);
        $apartments = array_slice($apartments, $pages->offset, $pages->limit);

        if($request->post('addApartment') && $newApartment->load($request->post()) && $newApartment->validate())
        {
            $newApartment->save();
            HousesApartments::AddApartmentToHouse($id, $newApartment->id);
        }

        return $this->render('view', [
            'model' => $model,
            'residence' => ResidentialComplexes::findOne($model->residential_com_id),
            'newApartment' => $newApartment,
            'typeList' => ApartmentsType::getTypesArr(),
            'apartmentsList' => $apartments,
            "pages" => $pages
        ]);
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
