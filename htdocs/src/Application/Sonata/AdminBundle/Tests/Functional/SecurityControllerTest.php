<?php

namespace Application\Sonata\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Form;

use Application\Sonata\AdminBundle\Tests\Functional\AbstractLoginTest;

class SecurityControllerTest extends AbstractLoginTest
{
    const ALERT_BLOCK_CLASS = '.alert';
    const INVALID_CREDENTIALS = 'Invalid credentials.';

    /**
     * @dataProvider dataProviderInvalidCredentials
     */
    public function testLoginFail($username, $password)
    {
        $this->submitLoginForm($username, $password);
        $this->assertEquals(self::LOGIN_URL, $this->client->getRequest()->getRequestUri());
        $validationError = $this->crawler->filter(self::ALERT_BLOCK_CLASS)->text();
        $this->assertEquals($validationError, self::INVALID_CREDENTIALS);
    }

    public function testLoginSuccess()
    {
        $this->submitLoginForm(self::USERNAME, self::PASSWORD);
        $validationError = $this->crawler->filter(self::ALERT_BLOCK_CLASS);
        $this->assertEmpty($validationError);
        $this->assertNotEquals(self::LOGIN_URL, $this->client->getRequest()->getRequestUri());
    }

    /**
     * @return array
     */
    public function dataProviderInvalidCredentials()
    {
        return [
            'empty username and password' => [
                'username' => '',
                'password' => ''
            ],
            'empty password' => [
                'username' => 'test',
                'password' => ''
            ],
            'empty username' => [
                'username' => '',
                'password' => 'test'
            ]
        ];
    }
}
