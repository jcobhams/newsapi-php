<?php

namespace jcobhams\NewsApi;

/**
 *  @author Joseph Cobhams
 */

class NewsApiAuth
{
	private $api_key;
	public function __construct($api_key)
	{
		$this->api_key = $api_key;
	}

	public function AuthHeaders()
	{
		return array(
			'Accept' => 'application/json',
			'Authorization' => "Bearer {$this->api_key}");
	}
}