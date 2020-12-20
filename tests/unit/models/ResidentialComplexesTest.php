<?php


namespace tests\unit\models;


use app\models\ResidentialComplexes;

class ResidentialComplexesTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testFindById()
    {
        expect_that($a = ResidentialComplexes::findOne(1));
        expect($a->id)->equals(1);

        expect_not(ResidentialComplexes::findOne(999));
    }

    public function testGetAllResidentialComplexes()
    {
        $allModels = ResidentialComplexes::find()->asArray()->all();
        $methodResult = ResidentialComplexes::getAllResidentialComplexes();

        foreach ($allModels as $rc) {
            expect_that(in_array($rc, $methodResult));
        }
    }


    public function testGetAllResidentialComplexesAppropriateResult()
    {
        $methodResult = ResidentialComplexes::getAllResidentialComplexes();

        expect($methodResult)->notNull();
        expect($methodResult)->Array();

    }
}