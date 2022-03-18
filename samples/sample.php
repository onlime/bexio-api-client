<?php
require_once '../vendor/autoload.php';

use Bexio\Client;
use Bexio\Resource\Contact;

/**
 * $clientId: The client ID you have received from Bexio developer portal (https://developer.bexio.com/).
 * $clientSecret: The client secret you have received from Bexio developer portal (https://developer.bexio.com/).
 * $tokensFile: Set the path where the credentials file was stored in auth.php.
 */
$clientId = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';
$clientSecret = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$tokensFile = 'client_tokens.json';

$client = new Client($clientId, $clientSecret);
$client->loadTokens($tokensFile);

$bexioContact = new Contact($client);
$contacts = $bexioContact->getContacts();

print_r($contacts);
