<?php

class AuthorizationCest
{
    function _before(FunctionalTester $I)
    {
        $I->amOnPage('/admin');
    }


    protected function logout(FunctionalTester $I)
    {
        $I->amOnPage(AuthorizationPage::$LOGOUT_URL);
        $I->amOnPage(AuthorizationPage::$DASHBOARD_URL);
        $I->dontSee(
            AuthorizationPage::$SEE_ELEMENT_ON_DASHBOARD,
            AuthorizationPage::$SELECTOR_ELEMENT_ON_DASHBOARD
        );
    }

    /**
     * @after logout
     * @param FunctionalTester $I
     */
    public function authAsAdmin(FunctionalTester $I)
    {
        $this->setFormFields($I, AuthorizationPage::$USERNAME, AuthorizationPage::$PASSWORD);
        $I->expect(AuthorizationPage::$EXPECT_SUCCESS_LOGIN);
        $I->amOnPage(AuthorizationPage::$DASHBOARD_URL);
        $I->see(
            AuthorizationPage::$SEE_ELEMENT_ON_DASHBOARD,
            AuthorizationPage::$SELECTOR_ELEMENT_ON_DASHBOARD
        );
    }

    public function authWithBadCredentials(FunctionalTester $I)
    {
        $this->setFormFields($I, AuthorizationPage::$BAD_USERNAME, AuthorizationPage::$BAD_PASSWORD);
        $I->expect(AuthorizationPage::$EXPECT_ERROR_LOGIN);
        $I->seeElement(AuthorizationPage::$ERROR_FLASH_MESSAGE_ELEMENT);
    }

    private function setFormFields(FunctionalTester $I, $email, $password)
    {
        $I->fillField(AuthorizationPage::$USERNAME_FIELD, $email);
        $I->fillField(AuthorizationPage::$PASSWORD_FIELD, $password);
        $I->click(AuthorizationPage::$SUBMIT_BUTTON);
    }
}
