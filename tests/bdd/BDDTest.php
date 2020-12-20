<?php


use app\models\Houses;

class BDDTest extends \Codeception\Test\Unit
{
    public function testFindByName()
    {
        expect_that($house = Houses::findOne(['name' => 'Очередь 1 Дом 1']));
        expect($house->name)->equals('Очередь 1 Дом 1');

        expect_not($house->name == Houses::findOne(['name' => 'Дом 2']));
    }
}