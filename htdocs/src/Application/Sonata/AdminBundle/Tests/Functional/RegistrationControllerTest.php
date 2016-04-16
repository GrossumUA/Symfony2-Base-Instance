<?php

namespace Application\Sonata\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Form;

class RegistrationControllerTest extends WebTestCase
{
    const ALERT_BLOCK_CLASS = '.alert';
    const ERROR_SELECTOR = '.has-error .help-block li';
    const EMAIL_FIELD = 'fos_user_registration_form[email]';
    const EMPTY_USERNAME_ERROR = ' Please enter a username';
    const REGISTRATION_URL = '/register';
    const INVALID_CREDENTIALS = 'Invalid credentials.';
    const PASSWORD_FIELD = 'fos_user_registration_form[plainPassword][first]';
    const REPEAT_PASSWORD_FIELD = 'fos_user_registration_form[plainPassword][second]';
    const SUBMIT_BUTTON = 'Register';
    const USERNAME_FIELD = 'fos_user_registration_form[username]';
    const USERNAME = 'test';
    const EMAIL = 'test@test.com';
    const PASSWORD = 'admin';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Crawler
     */
    protected $crawler;

    /**
     * @var Form
     */
    protected $form;

    protected function setUp()
    {
        $this->client = static::createClient();
        $this->client->followRedirects(true);
        $this->crawler = $this->client->request('GET', self::REGISTRATION_URL);
        $this->form = $this->crawler->selectButton(self::SUBMIT_BUTTON)->form();
    }

    /**
     * @dataProvider dataProviderInvalidCredentials
     */
    public function testRegistrationFail($username, $email, $password, $repeatPassword, $countErrors)
    {
        $this->form[self::USERNAME_FIELD] = $username;
        $this->form[self::EMAIL_FIELD] = $email;
        $this->form[self::PASSWORD_FIELD] = $password;
        $this->form[self::REPEAT_PASSWORD_FIELD] = $repeatPassword;

        $this->crawler = $this->client->submit($this->form);
        $this->assertEquals(self::REGISTRATION_URL, $this->client->getRequest()->getRequestUri());
        $this->assertEquals($this->crawler->filter(self::ERROR_SELECTOR)->count(), $countErrors);
    }

    public function testRegisterSuccess()
    {
        $this->form[self::USERNAME_FIELD] = self::USERNAME;
        $this->form[self::EMAIL_FIELD] = self::EMAIL;
        $this->form[self::PASSWORD_FIELD] = self::PASSWORD;
        $this->form[self::REPEAT_PASSWORD_FIELD] = self::PASSWORD;

        $this->crawler = $this->client->submit($this->form);
        $this->assertEmpty($this->crawler->filter(self::ERROR_SELECTOR));
        $this->assertNotEquals(self::REGISTRATION_URL, $this->client->getRequest()->getRequestUri());
    }

    /**
     * @return array
     */
    public function dataProviderInvalidCredentials()
    {
        return [
            'empty username, email and password' => [
                'username'       => '',
                'email'          => '',
                'password'       => '',
                'repeatPassword' => '',
                'countErrors'    => 3
            ],
            'empty email and password' => [
                'username'       => 'test',
                'email'          => '',
                'password'       => '',
                'repeatPassword' => '',
                'countErrors'    => 2
            ],
            'empty password' => [
                'username'       => 'test',
                'email'          => 'test@test.com',
                'password'       => '',
                'repeatPassword' => '',
                'countErrors'    => 1
            ],
            'incorrect email' => [
                'username'       => 'test',
                'email'          => 'test',
                'password'       => '123',
                'repeatPassword' => '123',
                'countErrors'    => 1
            ],
            'password do not much' => [
                'username'       => 'test',
                'email'          => 'test@test.com',
                'password'       => '321',
                'repeatPassword' => '123',
                'countErrors'    => 1
            ]
        ];
    }
}
