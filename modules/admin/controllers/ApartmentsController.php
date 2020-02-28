<?php


namespace app\modules\admin\controllers;


use app\models\Apartments;
use app\models\ApartmentsType;
use app\models\HousesApartments;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ApartmentsController extends Controller
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
     * Deletes an existing Apartments model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $houseId = HousesApartments::getHouseId($id);
        $this->findModel($id)->delete();

        return $this->redirect(['houses/view', 'id' => $houseId]);
    }

    /**
     * Updates an existing Apartments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['houses/view', 'id' => HousesApartments::getHouseId($id)]);
        }

        return $this->render('update', [
            'apartment' => $model,
            'typeList' => ApartmentsType::getTypesArr()
        ]);
    }

    public function actionCreate($houseId)
    {
        $newApartment = new Apartments();
        if($newApartment->load(Yii::$app->request->post()) && $newApartment->validate())
        {
            $newApartment->save();
            HousesApartments::AddApartmentToHouse($houseId, $newApartment->id);
        }
        return $this->redirect(['houses/view', 'id' => $houseId]);
    }

    public function actionCreateTypical($rcId)
    {
        $newApartment = new Apartments();
        if($newApartment->load(Yii::$app->request->post()) && $newApartment->validate())
        {
            $newApartment->save();
            HousesApartments::AddApartmentToResidence($rcId, $newApartment->id);
        }
        return $this->redirect(['default/view', 'id' =>  $rcId]);
    }

    /**
     * Finds the Apartments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Apartments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apartments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}