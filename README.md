# Bexio API PHP Client

The bexio API Client Library enables you to work with the bexio API.
This is an early version and is still in development.

See the [bexio API documentation](https://docs.bexio.com) for more information how to use the API.

## Installation

You can use **Composer** or download the library.

Require this package with composer:

```sh
$ composer require onlime/bexio-api-client
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
$redirectUrl = 'http://localhost:8000/auth.php';
$scopes = ['openid', 'profile', 'contact_edit', 'offline_access', 'kb_invoice_edit', 'bank_payment_edit'];
$tokensFile = 'client_tokens.json';

$client = new Client($clientId, $clientSecret);
$client->authenticate($scopes, $redirectUrl);
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

Usage:

1. Ensure you have allowed your local direct URL in [Bexio Developer Portal](https://developer.bexio.com/), e.g. `http://localhost:8000/auth.php`
2. Fill `$clientId` and `$clientSecret` in both `samples/auth.php` and `samples/sample.php` with your Bexio API credentials.
3. Fire up the local dev server (see below).
4. Access http://localhost:8000/auth.php in your browser.
5. Authenticate with your Bexio login to provide access to the app via access token.
6. Bexio will redirect you back to http://localhost:8000/auth.php which will present: **Sucessfully authenticated. [Proceed to sample.php](http://localhost:8000/auth.php)**
7. Once you access http://localhost:8000/sample.php, you should be already authenticated (using the current token stored in `client_tokens.json`) and your contacts are listed.

```bash
$ cd samples/
$ php -S localhost:8000
```

## Authors

Author of this awesome package is [Philip Iezzi (Onlime GmbH)](https://www.onlime.ch/).

Large parts of this package were ported from the original [christianruhstaller/bexio-api-php-client](https://github.com/christianruhstaller/bexio-api-php-client). Credits go to [Christian Ruhstaller](https://github.com/christianruhstaller), the bolloon guy.

This fork was detached from the original repository in March 2022, as the codebases have diverged quite a bit. Beware: Both projects currently don't represent a full-featured Bexio API client library, both being limited to just a subset of all API methods.

## License

This package is licenced under the [MIT license](LICENSE) however support is more than welcome.
