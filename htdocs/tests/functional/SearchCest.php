<?php

class SearchCest extends AdminAuthBase
{
    function _before(FunctionalTester $I)
    {
        $I->amOnPage('/admin');
    }

    public function search(FunctionalTester $I)
    {
        $this->authAsAdmin($I);
        $this->setFormFields($I, SearchPage::$SEARCH);
        $I->see(SearchPage::$SEARCH, SearchPage::$SEARCH_RESULT_BY_USERNAME);
    }

    public function badSearch(FunctionalTester $I)
    {
        $this->authAsAdmin($I);
        $this->setFormFields($I, SearchPage::$BAD_SEARCH);
        $I->dontSee(SearchPage::$SEARCH, SearchPage::$SEARCH_RESULT_BY_USERNAME);
    }

    private function setFormFields(FunctionalTester $I, $search)
    {
        $I->fillField(SearchPage::$SEARCH_FIELD, $search);
        $I->click(SearchPage::$SUBMIT_SEARCH_BUTTON);
    }
}
