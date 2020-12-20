<?php


namespace tests\unit\models;


use app\models\Apartments;
use app\models\ApartmentsType;

class ApartmentsTypeTest  extends \Codeception\Test\Unit
{
    public function testFindById()
    {
        expect_that($type = ApartmentsType::findOne(1));
        expect($type->id)->equals(1);

        expect_not(ApartmentsType::findOne(999));
    }

    public function testGetApartments()
    {
        expect_that($type = ApartmentsType::findOne(1));
        $apartments = $type->getApartments()->asArray()->all();
        expect($apartments)->Array();

        foreach ($apartments as $a) {
            expect_that($a['type_id'] == $type->id);
        }
    }

    public function testGetTypesArr()
    {
        expect_that($type = ApartmentsType::findOne(1));
        expect($type->getTypesArr())->Array();
        $typesArr = [];
        $types = ApartmentsType::find()->select(['id', 'name'])->all();

        foreach($types as $value)
        {
            $typesArr[$value['id']] = $value['name'];
        }

        foreach ($type->getTypesArr() as $a) {
            expect_that(in_array($a, $typesArr));
        }
    }

    public function testGetTypesArrNotNull()
    {
        expect_that($type = ApartmentsType::findOne(1));
        expect($type->getTypesArr())->NotNull();

    }

    public function testGetApartmentsNotNull()
    {
        expect_that($type = ApartmentsType::findOne(1));
        expect($type->getApartments())->NotNull();
    }
}