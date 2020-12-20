<?php

use yii\helpers\Url;

class AboutCest
{
    public function ensureThatMainWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/'));
        $I->see('Квартиры', 'h1');
    }
}
