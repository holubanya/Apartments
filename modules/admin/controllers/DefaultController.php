<?php

namespace app\modules\admin\controllers;

use app\models\Apartments;
use app\models\ApartmentsType;
use app\models\Houses;
use app\models\HousesApartments;
use Yii;
use app\models\ResidentialComplexes;
use app\models\ResidentialComplexesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;

/**
 * DefaultController implements the CRUD actions for ResidentialComplexes model.
 */
class DefaultController extends Controller
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
     * Lists all ResidentialComplexes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $residentialComplexes = ResidentialComplexes::getAllResidentialComplexes();

        return $this->render('index', [
            'residentialComplexes' => $residentialComplexes,
        ]);
    }

    /**
     * Displays a single ResidentialComplexes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $newHouse = new Houses();
        $newHouse->residential_com_id = $id;
        $newApartment = new Apartments();

        if($request->post('addHouse') && $newHouse->load($request->post()) && $newHouse->validate())
        {
            $newHouse->save();
        }

        if($request->post('addApartment') && $newApartment->load($request->post()) && $newApartment->validate())
        {
            $newApartment->save();
            HousesApartments::AddApartmentToResidence($id, $newApartment->id);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'houses' => Houses::getHousesByResidenceId($id),
            'newHouse' => $newHouse,
            'newApartment' => $newApartment,
            'typeList' => ApartmentsType::getTypesArr()
        ]);
    }

    /**
     * Creates a new ResidentialComplexes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ResidentialComplexes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ResidentialComplexes model.
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
     * Deletes an existing ResidentialComplexes model.
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

    /**
     * Finds the ResidentialComplexes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ResidentialComplexes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ResidentialComplexes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
