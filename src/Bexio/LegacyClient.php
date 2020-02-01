<?php
namespace Bexio;

use GuzzleHttp\Client as GuzzleClient;

class LegacyClient extends AbstractClient
{
    const API_URL = 'https://office.bexio.com/api2.php';

    /**
     * @var string
     */
    private $companyId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $signatureKey;

    /**
     * LegacyClient constructor.
     *
     * @param string $companyId
     * @param string $userId
     * @param string $publicKey
     * @param string $signatureKey
     */
    public function __construct(string $companyId, string $userId, string $publicKey, string $signatureKey)
    {
        $this->companyId    = $companyId;
        $this->userId       = $userId;
        $this->publicKey    = $publicKey;
        $this->signatureKey = $signatureKey;
    }

    /**
     * @param string $path
     * @param string $method
     * @param array $data
     * @return mixed
     */
    protected function request(string $path = '', string $method = self::METHOD_GET, array $data = [])
    {
        $apiUrl = implode('/', [
            self::API_URL,
            $this->companyId,
            $this->userId,
            $this->publicKey,
            $path
        ]);

        $options = [
            'headers' => [
                'Signature' => $this->getSignature($apiUrl, $method, $data),
                'Accept' => 'application/json'
            ],
            'allow_redirects' => false
        ];
        if (!empty($data)) {
            $options[(self::METHOD_GET == $method) ? 'query' : 'json'] = $data;
        }

        $client   = new GuzzleClient();
        $response = $client->request($method, $apiUrl, $options);
        $body     = $response->getBody();

        return json_decode($body);
    }

    /**
     * Build md5 signature for old api authentication (public / signature key).
     * https://docs.bexio.com/legacy/key_version/
     *
     * @param string $apiUrl
     * @param string $method
     * @param array $data
     * @return string
     */
    protected function getSignature(string $apiUrl, string $method, array $data = []): string
    {
        $payload = empty($data) ? '' : \json_encode($data);
        return md5(strtolower($method) . $apiUrl . $payload . $this->signatureKey);
    }
}
