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

$bexioContact = new Contact($client);
$contacts = $bexioContact->getContacts();

print_r($contacts);
