<?php

namespace app\controllers;

use app\models\ApartmentsType;
use Yii;
use app\models\ApartmentsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;



class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }
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
