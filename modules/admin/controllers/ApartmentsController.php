<?php


namespace app\modules\admin\controllers;


use app\models\Apartments;
use app\models\ApartmentsType;
use app\models\HousesApartments;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ApartmentsController extends Controller
{
    /**
     * Deletes an existing Apartments model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['houses/view', 'id' =>  $this->getHouseId($id)]);
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
            return $this->redirect(['houses/view', 'id' => $this->getHouseId($id)]);
        }

        return $this->render('update', [
            'apartment' => $model,
            'typeList' => ApartmentsType::getTypesArr()
        ]);
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

    public function getHouseId($aId)
    {
        $haModel = HousesApartments::findOne(['apartment_id' => $aId]);
        return $haModel->house_id;
    }
}