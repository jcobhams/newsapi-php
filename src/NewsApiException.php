<?php

namespace jcobhams\NewsApi;


class NewsApiException extends \Exception
{
	public function errorMessage() {
		//error message
		return "{$this->getMessage()} on line {$this->getLine()} in file {$this->getFile()}";
	}
}