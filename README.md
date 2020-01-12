# bexio API PHP Client

The bexio API Client Library enables you to work with the bexio API.
This is an early version and is still in development.

See the [bexio API documentation](https://docs.bexio.com) for more information how to use the API.

## Installation

You can use **Composer** or download the library.

Require this package with composer:

```sh
$ composer require christianruhstaller/bexio-api-php-client
```
Include the autoloader:

```php
require_once '/path/to/your-project/vendor/autoload.php';
```

## Examples

> A fully working example can be found in `samples/` directory.

Authenticate to get access and refresh tokens:

```php
<?php
require_once '../vendor/autoload.php';

use Bexio\Client;

$clientId = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';
$clientSecret = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$redirectUrl = 'http://bexio-api-php-client.test/auth.php';
$scopes = ['openid', 'profile', 'contact_edit', 'offline_access', 'kb_invoice_edit', 'bank_payment_edit'];
$tokensFile = 'client_tokens.json';

$client = new Client($clientId, $clientSecret, $redirectUrl);
$refreshToken = $client->authenticate($scopes);

file_put_contents($tokensFile, json_encode([
    'accessToken' => $client->getAccessToken(),
    'refreshToken' => $refreshToken
]));
```

Init client:

```php
<?php
require_once '../vendor/autoload.php';

use Bexio\Client;

$clientId = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';
$clientSecret = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$tokensFile = 'client_tokens.json';

$client = new Client($clientId, $clientSecret);

// Load previously authorized credentials from a file
if (!file_exists($tokensFile)) {
    throw new Exception('Tokens file not found for OpenID Connect auth: ' . $tokensFile);
}
$tokens = json_decode(file_get_contents($tokensFile));
$client->setAccessToken($tokens->accessToken);
// Refresh access token if it is expired
if ($client->isAccessTokenExpired()) {
    $refreshToken = $client->refreshToken($tokens->refreshToken);
    // store new tokens
    file_put_contents($tokensFile, json_encode([
        'accessToken' => $client->getAccessToken(),
        'refreshToken' => $refreshToken
    ]));
}
```

Get contacts:

```php
<?php
use Bexio\Resource\Contact;

$bexioContact = new Contact($client);
$contacts = $bexioContact->getContacts();
```
