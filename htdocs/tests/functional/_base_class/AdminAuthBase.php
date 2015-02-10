<?php

abstract class AdminAuthBase
{

    /**
     * @param \FunctionalTester $I
     */
    protected function authAsAdmin(\FunctionalTester $I)
    {
        $I->amOnPage(AuthorizationPage::$LOGOUT_URL);
        $I->amOnPage(AuthorizationPage::$LOGIN_URL);
        $I->fillField(AuthorizationPage::$USERNAME_FIELD, AuthorizationPage::$USERNAME);
        $I->fillField(AuthorizationPage::$PASSWORD_FIELD, AuthorizationPage::$PASSWORD);
        $I->click(AuthorizationPage::$SUBMIT_BUTTON);
        $I->expect(AuthorizationPage::$EXPECT_SUCCESS_LOGIN);
        $I->amOnPage(AuthorizationPage::$DASHBOARD_URL);
        $I->see(AuthorizationPage::$SEE_ELEMENT_ON_DASHBOARD);
    }

    /**
     * @param \FunctionalTester $I
     */
    protected function logout(\FunctionalTester $I)
    {
        $I->amOnPage(AuthorizationPage::$LOGOUT_URL);
        $I->amOnPage(AuthorizationPage::$DASHBOARD_URL);
        $I->dontSee(AuthorizationPage::$SEE_ELEMENT_ON_DASHBOARD);
    }

}