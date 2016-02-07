<?php

namespace Application\Sonata\AdminBundle\Tests\Functional;

class SearchTest extends AbstractLoginTest
{
    const ADMIN_URL = '/admin';
    const BAD_SEARCH_QUERY = 'badAdmin';
    const COUNT_EMPTY_RESULT = 0;
    const SEARCH_RESULT = '//*/div/div/h4/span';
    const SEARCH_FIELD = 'q';
    const SEARCH_QUERY = 'admin';

    /**
     * @var Form
     */
    protected $searchForm;

    protected function setUp()
    {
        parent::setUp();
        $this->submitLoginForm(self::USERNAME, self::PASSWORD);
        $this->crawler = $this->client->request('GET', self::ADMIN_URL);
        $this->searchForm = $this->crawler->selectButton('')->form();
    }

    public function testBadSearch()
    {
        $this->submitSearch(self::BAD_SEARCH_QUERY);
        $this->assertEquals(self::COUNT_EMPTY_RESULT, $this->crawler->filterXPath(self::SEARCH_RESULT)->count());
    }

    public function testSearch()
    {
        $this->submitSearch(self::SEARCH_QUERY);
        $this->assertNotEquals(self::COUNT_EMPTY_RESULT, $this->crawler->filterXPath(self::SEARCH_RESULT)->count());
    }

    /**
     * @param string $query
     */
    protected function submitSearch($query)
    {
        $this->searchForm[self::SEARCH_FIELD] = $query;

        $this->crawler = $this->client->submit($this->searchForm);
    }
}
