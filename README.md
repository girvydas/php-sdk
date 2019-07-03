# Teamgate API SDK for PHP
A cloud-based intelligent Sales CRM for small and mid-size teams. With its simple yet playful interface, Teamgate is a great sales stack for today’s business. See https://www.teamgate.com for details.
This is the official Teamgate API wrapper-client for PHP based apps, distributed by Teamgate Ltd. freely under the MIT licence.

# Prerequisites
You will need to make sure your server meets the following requirements:
- PHP >= 5.5
- The PHP cURL extension

# Getting Started
You can install via composer or by downloading the source. 
[Teamgate API](http://docs.teamgate.com/reference/) client utilizes Composer to manage its dependencies. So, before using Teamgate API client, make sure you have Composer installed on your machine.

## Install Composer In Your Project
Run this in your command line:
```bash
curl -sS https://getcomposer.org/installer | php
```
## Installation
To install run:
```bash
composer require teamgate/php-api-sdk:dev-master
```

## Autoloading
For libraries that specify autoload information, [Composer](https://getcomposer.org/download/) generates a `vendor/autoload.php` file. You can simply include this file and you will get autoloading for free.
```php
require __DIR__ . '/vendor/autoload.php';
```

# Basic Usage
Here's a quick example that will list some deals from your Teamgate account:
```php
require __DIR__ . '/vendor/autoload.php';

$api = new \Teamgate\API([
    'apiKey' => '_YOUR_ACCOUNT_API_KEY_', // located at account settings -> additional features -> external apps
    'authToken' => '_YOUR_PERSONAL_AUTH_TOKEN_' // located at user settings -> preferences
]);

$result = $api->deals->get([
        'offset' => 0, 
        'limit' => 10
    ]
);
var_dump($result);
```
[Lead management](https://www.teamgate.com/solutions/lead-management/) is an important part of any [sales process](https://www.teamgate.com/solutions/sales-pipeline-management/). Create a new lead automatically whenever a visitor fills out a form on your site:
```php
require __DIR__ . '/vendor/autoload.php';

$api = new \Teamgate\API([
    'apiKey' => '_YOUR_ACCOUNT_API_KEY_', // located at account settings -> additional features -> external apps
    'authToken' => '_YOUR_PERSONAL_AUTH_TOKEN_' // located at user settings -> preferences
]);

$result = $api->leads->create(
  [
    'title' => 'The Company Name'
  ]
);
var_dump($result);
```

## Error Handling
When you instantiate a client or make any request via service objects, exceptions can be raised for multiple of reasons e.g. a server error, an authentication error, an invalid params and etc.

Below shows how to properly handle exceptions:
```php
require __DIR__ . '/vendor/autoload.php';

try 
{
  $api = new \Teamgate\API([
      'apiKey' => '_YOUR_ACCOUNT_API_KEY_', // located at account settings -> additional features -> external apps
      'authToken' => '_YOUR_PERSONAL_AUTH_TOKEN_' // located at user settings -> preferences
  ]);
  $result = $api->leads->create(
    [
      'title' => 'The Company Name'
    ]
  ));
  var_dump($result);
} 
catch (Teamgate\Exception\ValidationException $e) 
{
  /* Invalid client configuration */
} 
catch (Teamgate\Exception\TransportException $e) 
{
  var_dump($e->getCode()); // HTTP Status Code
  var_dump($e->output); // Teamgate API Output
}
catch (Teamgate\Exception\ResponseException $e) 
{
  /* Invalid query parameters or etc. */
}
catch (Exception $e)
{
  /* Other kind of exception */
}
```
# Advanced Usage
For example retrieve all companies from your Teamgate account and change their logos by website domain through [Clearbit API](https://clearbit.com/docs#logo-api):
```php
require __DIR__ . '/vendor/autoload.php';

$api = new \Teamgate\API([
    'apiKey' => '_YOUR_ACCOUNT_API_KEY_', // located at account settings -> additional features -> external apps
    'authToken' => '_YOUR_PERSONAL_AUTH_TOKEN_' // located at user settings -> preferences
]);

$result = $api->companies->get([
        'offset' => 0, 
        'limit' => 10
    ]
);

foreach($result as $company) {
    if (!empty($company->data['urls']) && !empty($company->data['urls'][0] && !empty($company->data['urls'][0]['value']))
    {
        list($domain) = parse_url($company->data['urls'][0]['value'], PHP_URL_HOST);
        $logo = file_get_contents('https://logo.clearbit.com/' . $domain);
        if ($logo) {
            $company->changeLogo(
                [
                    'size' => strlen($logo),
                    'content' => base64_encode($logo)
                ]
            );
        }
    }
}

var_dump($result);
```

# Documentation
The documentation for the Teamgate API is located at http://docs.teamgate.com/reference/

# Getting Help
If you need help installing or using the library, please contact Teamgate Support at `support@teamgate.com`.
If you've instead found a bug in the library or [would like new features](https://www.teamgate.com/integration-request-forms/) added, go ahead and open issues or pull requests against this repo!
