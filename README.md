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

/**
 * $clientId: The client ID you have received from Bexio developer portal (https://developer.bexio.com/).
 * $clientSecret: The client secret you have received from Bexio developer portal (https://developer.bexio.com/).
 * $redirectUrl: Set your URL where this script gets called and set it as allowed redirect URL in your app settings in Bexio developer portal (https://developer.bexio.com/).
 * $scopes: A list of scopes (see https://docs.bexio.com/#section/Authentication/API-Scopes).
 * $tokensFile: Set the path where the credentials file will be stored.
 */
$clientId = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';
$clientSecret = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$redirectUrl = 'http://bexio-api-php-client.test/auth.php';
$scopes = ['openid', 'profile', 'contact_edit', 'offline_access', 'kb_invoice_edit', 'bank_payment_edit'];
$tokensFile = 'client_tokens.json';

$client = new Client($clientId, $clientSecret, $redirectUrl);
$client->authenticate($scopes);
$client->persistTokens($tokensFile);
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
$client->loadTokens($tokensFile);
```

Get contacts:

```php
<?php
use Bexio\Resource\Contact;

$bexioContact = new Contact($client);
$contacts = $bexioContact->getContacts();
```
