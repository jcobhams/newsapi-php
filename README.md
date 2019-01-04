## NewsAPI-PHP
A PHP client for the [News API](https://newsapi.org/docs/get-started).

### Installation
Available for installation on packagist using composer.
```
composer require jcobhams/newsapi
```

### Usage
After installation and and `require`ing `vendor/autoload.php` file in your project,

Get Your API key from [here](https://newsapi.org/register)
```php
use jcobhams\NewsApi\NewsApi;
.
.
.
$newsapi = new NewsApi($your_api_key);
```

### Get TopHeadLines
```
$newsapi->getTopHeadlines($q, $sources, $country, $category, $page_size, $page);

* $q : Keywords or a phrase to search for.

* $sources: A comma-seperated string of identifiers for the news sources or blogs you want headlines from. 
            Use the getSources() method to locate these programmatically or look at the sources index. 
            Note: you can't mix this param with the country or category params.
            
* $country: The 2-letter ISO 3166-1 code of the country you want to get headlines for. 
            Use the getCountries() method to locate these programmatically. 
            Note: you can't mix this param with the sources param.
            
* $category: The category you want to get headlines for. Use the getCategories() method to locate these programmatically. 
             Note: you can't mix this param with the sources param.

* $page_size: The number of results to return per page (request). 20 is the default, 100 is the maximum.

* $page: Use this to page through the results if the total results found is greater than the page size.

Returns JSON object is successful or throws excpetions if invalid data or unsuccessful request.
```

### Get Everything
```
$newsapi->getEverything($q, $sources, $domains, $exclude_domains, $from, $to, $language, $sort_by,  $page_size, $page);

* $domains: A comma-seperated string of domains (eg bbc.co.uk, techcrunch.com, engadget.com) to restrict the search to.

* $exclude_domains: A comma-seperated string of domains (eg bbc.co.uk, techcrunch.com, engadget.com) to remove from the results.

* $from: A date and optional time for the oldest article allowed. 
         This should be in ISO 8601 format (e.g. 2018-11-16 or 2018-11-16T16:19:03) 
         Default: the oldest according to your plan.

* $to: A date and optional time for the newest article allowed. 
       This should be in ISO 8601 format (e.g. 2018-11-16 or 2018-11-16T16:19:03) 
       Default: the newest according to your plan.

* $language: The 2-letter ISO-639-1 code of the language you want to get headlines for. 
             Possible options: ar de en es fr he it nl no pt ru se ud zh . 
             Default: all languages returned. Use the getLanguages() method to locate these programmatically.

* $sort_by: The order to sort the articles in. Use the getSortBy() method to locate these programmatically.

Returns JSON object is successful or throws excpetions if invalid data or unsuccessful request.
```

### Get New Sources
```
$newsapi->getSources($category, $language, $country)


Returns JSON object is successful or throws excpetions if invalid data or unsuccessful request.
```

### Get Countries
```
$newsapi->getCountries()

Returns an array of allowed countries
```

### Get Languages
```
$newsapi->getLanguages()

Returns an array of allowed languages
```

### Get Categories
```
$newsapi->getCategories()

Returns an array of allowed categories
```

### Get SortBy
```
$newsapi->getSortBy()

Returns an array of allowed sort_by
```

### CONTRIBUTORS

This package is authored by Joseph Cobhams.

### TODO
Write more unit tests, mocks and stubs.

