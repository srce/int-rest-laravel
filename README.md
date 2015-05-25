# int-rest-laravel

Package for accessing internal REST API in Laravel.

## Installation

Use `composer`:

`composer require srce/int-rest-laravel`

## Usage

I recomend storing REST data in `.env` file.

	$rest = new Srce\IntRest(getenv('REST_USER'), getenv('REST_PWD'), getenv('REST_HOST'));
	$data = $rest->getOrg('resource_name');

## Methods

Avaliable methods

	getOrg('resource_name')
	getPP('resource_name')
	getFin('resource_name')
	getLDAP('resource_name')
