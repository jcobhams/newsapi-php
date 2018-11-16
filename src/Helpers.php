<?php

namespace jcobhams\NewsApi;

/**
 *  @author Joseph Cobhams
 */

final class Helpers
{
	private static $countries = array(
		'ae', 'ar', 'at', 'au', 'be', 'bg', 'br', 'ca', 'ch', 'cn', 'co', 'cu', 'cz', 'de', 'eg', 'fr', 'gb', 'gr',
		'hk', 'hu','id','ie','il','in','it','jp','kr','lt','lv','ma','mx','my','ng','nl','no','nz','ph','pl', 'pt',
		'ro','rs','ru','sa','se','sg','si','sk','th','tr','tw','ua','us','ve','za');

	private static $languages = array('ar','en','cn','de','es','fr','he','it','nl','no','pt','ru','sv','ud');
	private static $categories = array('business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology');
	private static $sort = array('relevancy', 'popularity', 'publishedAt');

	final static public function topHeadlinesUrl($params=null){
		if(!is_null($params)){
			return "https://newsapi.org/v2/top-headlines?{$params}";
		}
		return 'https://newsapi.org/v2/top-headlines';
	}

	final static public function everythingUrl($params=null){
		if(!is_null($params)){
			return "https://newsapi.org/v2/everything?{$params}";
		}
		return 'https://newsapi.org/v2/everything';
	}

	final static public function sourcesUrl($params=null){
		if(!is_null($params)){
			return "https://newsapi.org/v2/sources?{$params}";
		}
		return 'https://newsapi.org/v2/sources';
	}

	final static public function isCountryValid($country){
		if(in_array($country, Helpers::$countries)){ return true; }
		return false;
	}

	final static public function isLanguageValid($language){
		if(in_array($language, Helpers::$languages)){ return true; }
		return false;
	}

	final static public function isCategoryValid($category){
		if(in_array($category, Helpers::$categories)){ return true; }
		return false;
	}

	final static public function isSortByValid($sort_by){
		if(in_array($sort_by, Helpers::$sort)){ return true; }
		return false;
	}

	final static public function __get__($key){
		if($key == 'countries'){ return Helpers::$countries;}
		if($key == 'languages'){ return Helpers::$languages;}
		if($key == 'categories'){ return Helpers::$categories;}
		if($key == 'sort'){ return Helpers::$sort;}
	}
}