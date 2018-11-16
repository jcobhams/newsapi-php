<?php
use PHPUnit\Framework\TestCase;
use jcobhams\NewsApi\NewsApi;
use jcobhams\NewsApi\NewsApiException;

class NewsApiTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->newsapi = new NewsApi('some-api-key');
	}

	//TOP HEADLINES ENDPOINT
	public function testGetTopHeadLinesThrowsNewsApiExceptionIfSourcesUsedWithCountry()
	{	$this->expectException(NewsApiException::class);
		$news = $this->newsapi->getTopHeadLines($q=null, $sources='bbc', $language='en', $country='ng');
	}

	public function testGetTopHeadLinesThrowsNewsApiExceptionIfInvalidCountryUsed()
	{	$this->expectException(NewsApiException::class);
		$news = $this->newsapi->getTopHeadLines($q=null, $sources=null, $language='en', $country='kl');
	}

	public function testGetTopHeadLinesThrowsNewsApiExceptionIfInvalidCategoryUsed()
	{	$this->expectException(NewsApiException::class);
		$news = $this->newsapi->getTopHeadLines($q=null, $sources=null, $language='en', $country='ng', $category='data');
	}

	public function testGetTopHeadLinesThrowsNewsApiExceptionIfInvalidPageSizeUsed()
	{	$this->expectException(NewsApiException::class);
		$news = $this->newsapi->getTopHeadLines($q=null, $sources=null, $language='en', $country='ng', $category='business', $page_size=1000);
	}

	public function testGetTopHeadLines(){
		//Write Mocks API Call and response test
		$this->assertTrue(true);
	}

	// EVERYTHING END-POINT
	public function testGetEverythingThrowsNewsApiExceptionIfInvalidLanguageUsed()
	{	$this->expectException(NewsApiException::class);
		$news = $this->newsapi->getEverything($q=null, $sources='mtv-news', $domains=null, $exclude_domains=null, $from=null, $to=null, $language='ek', $sort_by=null);
	}

	public function testGetEverythingThrowsNewsApiExceptionIfInvalidSortingUsed()
	{	$this->expectException(NewsApiException::class);
		$news = $this->newsapi->getEverything($q=null, $sources=null, $domains=null, $exclude_domains=null, $from=null, $to=null, $language='en', $sort_by='quality');
	}

	public function testGetEverythingThrowsNewsApiExceptionIfInvalidPageSizeUsed()
	{	$this->expectException(NewsApiException::class);
		$news = $this->newsapi->getEverything($q=null, $sources=null, $domains=null, $exclude_domains=null, $from=null, $to=null, $language='en', $sort_by=null, $page_size=1000);
	}

	public function testGetEverything(){
		$this->assertTrue(true);
	}

	//SOURCES END-POINT
	public function testGetSourcesThrowsNewsApiExceptionIfInvalidCategoryUsed()
	{	$this->expectException(NewsApiException::class);
		$this->newsapi->getSources($category='data', $language=null, $country=null);
	}

	public function testGetSourcesThrowsNewsApiExceptionIfInvalidLanguageUsed()
	{	$this->expectException(NewsApiException::class);
		$this->newsapi->getSources($category=null, $language='ek', $country=null);
	}

	public function testGetSourcesThrowsNewsApiExceptionIfInvalidCountryUsed()
	{	$this->expectException(NewsApiException::class);
		$this->newsapi->getSources($category=null, $language=null, $country='kl');
	}

	public function testGetSources(){
		//Write Mocks API Call and response test
		$this->assertTrue(true);
	}

}
