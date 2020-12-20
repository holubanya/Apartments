<?php


namespace tests\unit\models;


use app\models\ApartmentsType;
use app\models\HousesApartments;

class HousesApartmentsTest  extends \Codeception\Test\Unit
{
    public function testFindById()
    {
        expect_that($ha = HousesApartments::findOne(1));
        expect($ha->id)->equals(1);
    }

    public function testGetHouseId()
    {
        $aId = 2;
        expect_that($ha = HousesApartments::findOne(1));
        $haModel = HousesApartments::findOne(['apartment_id' => $aId]);
        $methodResult = $ha->getHouseId($aId);
        expect_that($haModel->house_id == $methodResult);
    }

    public function testGetHouse()
    {
        $ha = HousesApartments::findOne(1);
        $methodResult = $ha->getHouse()->one();
        expect($methodResult->id == $ha->house_id);
    }
}