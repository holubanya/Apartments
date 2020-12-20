<?php


namespace tests\unit\models;


use app\models\Apartments;
use app\models\ApartmentsType;
use app\models\Houses;

class HousesTest  extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function getHousesByResidenceId()
    {
        $RCId = 1;
        $houses = Houses::find()->select(['name', 'id'])->where(['residential_com_id' => $RCId])->all();
        $methodResult = Houses::getHousesByResidenceId($RCId);

        foreach ($houses as $house) {
            expect_that(in_array($house, $methodResult));
        }

    }

    public function testGetHousesApartments()
    {
        expect_that($house = Houses::findOne(1));
        expect($house->getHousesApartments())->notNull();
    }

    public function testFindById()
    {
        expect_that($house = Houses::findOne(1));
        expect($house->id)->equals(1);

        expect_not(Houses::findOne(999));
    }

    public function testFindByName()
    {
        expect_that($house = Houses::findOne(['name' => 'Очередь 1 Дом 1']));
        expect($house->name)->equals('Очередь 1 Дом 1');

        expect_not($house->name == Houses::findOne(['name' => 'Дом 2']));
    }

    public function testFindByNameNotNull()
    {
        expect_that($house = Houses::findOne(['name' => 'Очередь 1 Дом 1']));
        expect($house->name)->notNull();

        expect_not(Houses::findOne(['name' => 'Дом']));
    }


    public function testFindByNameInstanceOfHouse()
    {
        expect_that($house = Houses::findOne(['name' => 'Очередь 1 Дом 1']));
        expect_that($house instanceof Houses);
    }

}
