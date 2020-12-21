<?php


namespace functional;


class DealingErrorsTest
{
    public function submitFormWithOutArea(\FunctionalTester $I)
    {
        $I->submitForm('add-form', [
            'AddForm[apartments_type]' => '1',
            'AddForm[area]' => '',
            'AddForm[price]' => 2100000000,
        ]);
        $I->expectTo('see validation errors');
        $I->see('Необходимо заполнить «Общая площадь».', '.help-inline');
    }

    public function submitFormWithOutPrice(\FunctionalTester $I)
    {
        $I->submitForm('add-form', [
            'AddForm[apartments_type]' => '1',
            'AddForm[area]' => '125',
            'AddForm[price]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Необходимо заполнить «Стоимость».', '.help-inline');
    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Username cannot be blank.');
        $I->see('Пароль cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect username or password.');
    }

}