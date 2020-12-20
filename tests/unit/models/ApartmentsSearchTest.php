<?php


namespace tests\unit\models;


use app\models\Apartments;
use app\models\ApartmentsSearch;
use yii\data\ArrayDataProvider;

class ApartmentsSearchTest  extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testSearch()
    {
        $this->model = new ApartmentsSearch();

        expect($this->model->search())->notNull();

        expect_that($this->model->search() instanceof ArrayDataProvider);
    }

    public function testSearchByCity()
    {
        $this->model = new ApartmentsSearch([
            'city' => 'Киев'
        ]);
        $provider = Apartments::find()
            ->select(["rc.name AS rc_name", 'city', "h.name AS h_name",  'total_area', 'total_price'])
            ->leftJoin(['ha' => 'Houses_Apartments'], 'ha.apartment_id = Apartments.id')
            ->leftJoin(['h' => 'Houses'], 'ha.house_id = h.id')
            ->leftJoin(['rc' => 'Residential_Complexes'], 'h.residential_com_id = rc.id')
            ->where(['like', 'city', 'Киев'])
            ->asArray()
            ->all();

        foreach ($provider as $model) {
            expect_that(in_array($model, $this->model->search()->allModels));
        }
    }

    public function testSearchByType()
    {
        $this->model = new ApartmentsSearch([
            'apartment_type' => 2
        ]);
        $provider = Apartments::find()
            ->select(["rc.name AS rc_name", 'city', "h.name AS h_name",  'total_area', 'total_price'])
            ->leftJoin(['ha' => 'Houses_Apartments'], 'ha.apartment_id = Apartments.id')
            ->leftJoin(['h' => 'Houses'], 'ha.house_id = h.id')
            ->leftJoin(['rc' => 'Residential_Complexes'], 'h.residential_com_id = rc.id')
            ->where(['=', 'type_id', 2])
            ->asArray()
            ->all();

        foreach ($provider as $model) {
            expect_that(in_array($model, $this->model->search()->allModels));
        }

    }

    public function testSearchNotInCity()
    {
        $this->model = new ApartmentsSearch([
            'city' => 'Киев'
        ]);
        $provider = Apartments::find()
            ->select(["rc.name AS rc_name", 'city', "h.name AS h_name",  'total_area', 'total_price'])
            ->leftJoin(['ha' => 'Houses_Apartments'], 'ha.apartment_id = Apartments.id')
            ->leftJoin(['h' => 'Houses'], 'ha.house_id = h.id')
            ->leftJoin(['rc' => 'Residential_Complexes'], 'h.residential_com_id = rc.id')
            ->where(['not like', 'city', 'Киев'])
            ->asArray()
            ->all();

        foreach ($provider as $model) {
            expect_that(!in_array($model, $this->model->search()->allModels));
        }
    }


    public function testSearchNotInType()
    {
        $this->model = new ApartmentsSearch([
            'apartment_type' => 2
        ]);
        $provider = Apartments::find()
            ->select(["rc.name AS rc_name", 'city', "h.name AS h_name",  'total_area', 'total_price'])
            ->leftJoin(['ha' => 'Houses_Apartments'], 'ha.apartment_id = Apartments.id')
            ->leftJoin(['h' => 'Houses'], 'ha.house_id = h.id')
            ->leftJoin(['rc' => 'Residential_Complexes'], 'h.residential_com_id = rc.id')
            ->where(['!=', 'type_id', 2])
            ->asArray()
            ->all();

        foreach ($provider as $model) {
            expect_that(!in_array($model, $this->model->search()->allModels));
        }

    }
}