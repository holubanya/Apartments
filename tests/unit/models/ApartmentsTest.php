<?php

namespace tests\unit\models;

use app\models\Apartments;
use app\models\HousesApartments;
use yii\mail\MessageInterface;

class ApartmentsTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testFindFlatById()
    {
        expect_that($a = Apartments::findOne(1));
        expect($a->id)->equals(1);

        expect_not(Apartments::findOne(999));
    }

    public function testGetType()
    {
        expect_that($a = Apartments::findOne(1));
        expect($a->type_id)->equals(4);

        expect_not($a->type_id == 5);
    }

    public function testGetHousesApartments()
    {
        expect_that($house = HousesApartments::findOne(['apartment_id' => 1]));
        expect_that($a = Apartments::findOne(1));
        expect($a->getHousesApartments())->notNull();
    }


    public function testGetTypeNotNull()
    {
        expect_that($a = Apartments::findOne(1));
        expect($a->type_id)->equals(4);

        expect_not($a->type_id == null);
    }

    public function testFindById()
    {
        expect_that($a = Apartments::findOne(1));
        expect($a->id)->equals(1);
    }
}
