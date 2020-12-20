<?php


namespace tests\unit\models;


use app\models\Apartments;
use app\models\ApartmentsSearch;
use app\models\ApartmentsType;
use app\models\Houses;
use app\models\ResidentialComplexes;
use app\models\User;

class TimeTest extends \Codeception\Test\Unit
{
    public function testSearchingTime()
    {
        $start = microtime(true);

        $model = new ApartmentsSearch();
        $model->search();

        $time = microtime(true) - $start;
        expect_that($time <= 0.3);
    }

    public function testSearchingWithParametersTime()
    {
        $start = microtime(true);

        $model = new ApartmentsSearch([
            'city' => 'Киев'
        ]);
        $model->search();

        $time = microtime(true) - $start;
        expect_that($time <= 0.3);
    }

    public function testGettingRCTime()
    {
        $start = microtime(true);

        ResidentialComplexes::find()->all();

        $time = microtime(true) - $start;
        expect_that($time <= 0.3);
    }

    public function testGettingHousesTime()
    {
        $start = microtime(true);

        Houses::find()->all();

        $time = microtime(true) - $start;
        expect_that($time <= 0.3);
    }

    public function testGettingFlatsByTypeTime()
    {
        $start = microtime(true);

        $type = ApartmentsType::findOne(2);
        $type->getApartments()->all();

        $time = microtime(true) - $start;
        expect_that($time <= 0.3);
    }

    public function testGettingFlatsTime()
    {
        $start = microtime(true);

        Apartments::find()->all();

        $time = microtime(true) - $start;
        expect_that($time <= 0.3);
    }

    public function testAuthTime()
    {
        $start = microtime(true);

        $user = User::findIdentity(1);
        $user->validatePassword('password');
        $key = $user->getAuthKey();
        $user->validateAuthKey($key);

        microtime(true) - $start;
    }
}