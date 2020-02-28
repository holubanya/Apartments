<?php

namespace app\controllers;

use app\models\ApartmentsType;
use Yii;
use app\models\ApartmentsSearch;
use yii\web\Controller;



class SiteController extends Controller
{

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $searchModel = new ApartmentsSearch();

        if($request->post('search'))
        {
            $searchModel->load($request->post());
            $searchModel->validate();
        }
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'typeList' => ApartmentsType::getTypesArr()
        ]);
    }
}
