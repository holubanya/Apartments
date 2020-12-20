<?php

class SearchCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['/']);
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#w0', []);
        $I->dontSee('Type cannot be blank', '.help-inline');
        $I->dontSee('City cannot be blank', '.help-inline');
        $I->expectTo('see all results');
    }

    public function submitFormWithCity(\FunctionalTester $I)
    {
        $I->submitForm('#w0', [
            'SearchForm[city]' => 'Киев'
        ]);
        $I->expectTo('see flats in this city');
        $I->dontSee('Type cannot be blank', '.help-inline');
    }

    public function submitFormWithType(\FunctionalTester $I)
    {
        $I->submitForm('#w0', [
            'SearchForm[apartments_type]' => '1'
        ]);
        $I->expectTo('see flats of this type');
        $I->dontSee('City cannot be blank', '.help-inline');
    }

    public function submitFormWithTypeAndCity(\FunctionalTester $I)
    {
        $I->submitForm('#w0', [
            'SearchForm[apartments_type]' => '1',
            'SearchForm[city]' => 'Киев'
        ]);
        $I->expectTo('see flats of this type in this city');
    }
}
