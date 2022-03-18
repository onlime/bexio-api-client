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
?>
Sucessfully authenticated. <a href="sample.php">Proceed to sample.php</a>