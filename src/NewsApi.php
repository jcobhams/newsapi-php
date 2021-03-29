<?php
namespace jcobhams\NewsApi;

use GuzzleHttp\Client;
use PHPUnit\Runner\Exception;

/**
 *  @author Joseph Cobhams
 */
class NewsApi
{
	private $auth, $request_header;

	public function __construct($api_key)
	{
		$this->auth = new NewsApiAuth($api_key);
		$this->request_header = $this->auth->AuthHeaders();
		$this->client = new Client(['timeout'  => 30]);
	}

	public function getTopHeadLines($q=null, $sources=null, $country=null, $category=null, $page_size=null, $page=null)
	{
		//Returns live top and breaking headlines for a country, specific category in a country, single source, or multiple sources
		$payload = array();

		//Add Search keyword if provided
		if (!is_null($q)) {
			$payload['q'] = $q;
		}

		//Ensure sources is not mixed with country or category.
		if (!is_null($sources) && (!is_null($country) || !is_null($category))) {
			throw new NewsApiException("You Cannot Use Sources with Country or Category at the same time.");
		}

		//Add Sources if provided
		if (!is_null($sources)) {
			$payload['sources'] = $sources;
		}

		//Add country if provided
		if (!is_null($country)) {
			if (Helpers::isCountryValid($country)) { $payload['country'] = $country; }
			else { throw new NewsApiException("Invalid Country Identifier Provided"); }
		}

		//Add category if provided
		if (!is_null($category)) {
			if (Helpers::isCategoryValid($category)) { $payload['category'] = $category; }
			else { throw new NewsApiException("Invalid Category Identifier Provided"); }
		}

		if (!is_null($page_size)) {
			if ($page_size >= 1 && $page_size <= 100){ $payload['pageSize'] = $page_size; }
			else{ throw new NewsApiException("Invalid Page_size Value Provided"); }
		}

		if(!is_null($page)){ $payload['page']=$page; }

		//Make Request
		$url = Helpers::topHeadlinesUrl();
		try{
			$response = $this->client->request('GET', $url, ['headers'=>$this->request_header, 'query'=>$payload]);
			if($response->getStatusCode() == 200){
				return json_decode($response->getBody()->__toString());
			}
			else{
				$response_body = json_encode($response->getBody());
				throw new NewsApiException($response_body->message);
			}
		}
		catch (Exception $e)
		{
			throw new NewsApiException($e->getMessage());
		}


	}

	public function getEverything($q=null, $sources=null, $domains=null, $exclude_domains=null, $from=null, $to=null, $language='en', $sort_by=null,  $page_size=null, $page=null){
		//Search through millions of articles from small and big blogs.

		$payload = array();

		//Add Search keyword if provided
		if (!is_null($q)) { $payload['q'] = $q; }

		//Add Sources if provided
		if (!is_null($sources)) { $payload['sources'] = $sources; }

		//Add Domains if provided
		if (!is_null($domains)) { $payload['domains'] = $domains; }

		//Add ExcludeDomains if provided
		if (!is_null($exclude_domains)) { $payload['excludeDomains'] = $exclude_domains; }

		//Add From if provided
		if(!is_null($from))
		{
			if(strlen($from) < 10){ throw new NewsApiException('from argument must be YYYY-MM-DD format');}
			else{ $payload['from']=$from; }
		}

		//Add To if provided
		if(!is_null($to))
		{
			if(strlen($to) < 10){ throw new NewsApiException('to argument must be YYYY-MM-DD format');}
			else{ $payload['to']=$to; }
		}

		//Add Language if provided
		if (!is_null($language)) {
			if (Helpers::isLanguageValid($language)) { $payload['language'] = $language; }
			else {throw new NewsApiException("Invalid Language Identifier Provided "); }
		}

		//Add SortBy if provided
		if (!is_null($sort_by)) {
			if (Helpers::isSortByValid($sort_by)) { $payload['sortBy'] = $sort_by; }
			else {throw new NewsApiException("Invalid SortBy Identifier Provided "); }
		}

		if (!is_null($page_size)) {
			if ($page_size >= 1 && $page_size <= 100){ $payload['pageSize'] = $page_size; }
			else{ throw new NewsApiException("Invalid Page_size Value Provided"); }
		}

		if(!is_null($page)){ $payload['page']=$page; }

		//Make Request
		$url = Helpers::everythingUrl();
		try{
			$response = $this->client->request('GET', $url, ['headers'=>$this->request_header, 'query'=>$payload]);
			if($response->getStatusCode() == 200){
				return json_decode($response->getBody()->__toString());
			}
			else{
				$response_body = json_encode($response->getBody());
				throw new NewsApiException($response_body->message);
			}
		}
		catch (Exception $e)
		{
			throw new NewsApiException($e->getMessage());
		}

	}

	public function getSources($category=null, $language=null, $country=null){
		//Get News Sources

		//Add category if provided
		if (!is_null($category)) {
			if (Helpers::isCategoryValid($category)) { $payload['category'] = $category; }
			else { throw new NewsApiException("Invalid Category Identifier Provided"); }
		}

		//Add Language if provided
		if (!is_null($language)) {
			if (Helpers::isLanguageValid($language)) { $payload['language'] = $language; }
			else {throw new NewsApiException("Invalid Language Identifier Provided "); }
		}

		//Add country if provided
		if (!is_null($country)) {
			if (Helpers::isCountryValid($country)) { $payload['country'] = $country; }
			else { throw new NewsApiException("Invalid Country Identifier Provided"); }
		}

		//Make Request
		$url = Helpers::sourcesUrl();
		try{
			$response = $this->client->request('GET', $url, ['headers'=>$this->request_header, 'query'=>$payload]);
			if($response->getStatusCode() == 200){
				return json_decode($response->getBody()->__toString());
			}
			else{
				$response_body = json_encode($response->getBody());
				throw new NewsApiException($response_body->message);
			}
		}
		catch (Exception $e)
		{
			throw new NewsApiException($e->getMessage());
		}

	}

	public function getCountries(){ return Helpers::__get__('countries'); }
	public function getLanguages(){ return Helpers::__get__('languages'); }
	public function getCategories(){ return Helpers::__get__('categories'); }
	public function getSortBy(){ return Helpers::__get__('sort'); }
}
