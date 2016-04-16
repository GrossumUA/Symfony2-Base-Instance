<?php

namespace Application\Sonata\AdminBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpKernel\Client;

abstract class AbstractLoginTest extends WebTestCase
{
    const LOGIN_BUTTON = 'Login';
    const LOGIN_URL = '/admin/login';
    const PASSWORD = 'admin';
    const PASSWORD_FIELD = '_password';
    const USERNAME = 'admin';
    const USERNAME_FIELD = '_username';

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
    protected $loginForm;

    protected function setUp()
    {
        $this->client = static::createClient();
        $this->client->followRedirects(true);
        $this->crawler = $this->client->request('GET', self::LOGIN_URL);
        $this->loginForm = $this->crawler->selectButton(self::LOGIN_BUTTON)->form();
    }

    /**
     * @param string $username
     * @param string $password
     */
    protected function submitLoginForm($username, $password)
    {
        $this->loginForm[self::USERNAME_FIELD] = $username;
        $this->loginForm[self::PASSWORD_FIELD] = $password;

        $this->crawler = $this->client->submit($this->loginForm);
    }
}
