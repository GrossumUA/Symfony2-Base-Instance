<?php

class AuthorizationPage
{
    public static $LOGOUT_URL = '/logout';
    public static $LOGIN_URL = '/admin/login';
    public static $DASHBOARD_URL = '/admin/dashboard';


    public static $USERNAME_FIELD = '#username';
    public static $PASSWORD_FIELD = '#password';

    public static $USERNAME = 'admin';
    public static $PASSWORD = 'admin';

    public static $BAD_USERNAME = 'badAdmin';
    public static $BAD_PASSWORD = 'badAdmin';

    public static $SUBMIT_BUTTON = '#_submit';
    public static $EXPECT_SUCCESS_LOGIN = 'I am redirected to admin dashboard';
    public static $EXPECT_ERROR_LOGIN = 'I am not redirected to admin dashboard';

    public static $SEE_ELEMENT_ON_DASHBOARD = 'User';
    public static $SELECTOR_ELEMENT_ON_DASHBOARD = '//*/div/div[1]';
    public static $ERROR_FLASH_MESSAGE_ELEMENT = '.alert-error';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: EditPage::route('/123-post');
     */
    public static function route($param)
    {
        return static::$LOGIN_URL . $param;
    }

    /**
     * @var FunctionalTester;
     */
    protected $functionalTester;

    public function __construct(FunctionalTester $I)
    {
        $this->functionalTester = $I;
    }

    /**
     * @return AuthorizationPage
     */
    public static function of(FunctionalTester $I)
    {
        return new static($I);
    }
}
