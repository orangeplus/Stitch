<?php
namespace orangeplus\Stitch;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Class Client
 *
 * Cruft for composer setup
 *
 */
class Client
{
    /** @var string */
    private $baseUrl = 'https://api-pub.stitchlabs.com';
    /** @var string */
    private $accessToken;
    /** @var string */
    private $clientSecret;
    /** @var string */
    const RESPONSE_TYPE = 'code';
    /** @var GuzzleClient */
    private $client;
    private $headers;

    /**
     * Client constructor.
     *
     * @param $accessToken
     */
    public function __construct($accessToken, $baseUrl = null)
    {
        $this->accessToken = $accessToken;
        if ($baseUrl){
            $this->baseUrl = $baseUrl;
        }

        $this->headers['token'] = $this->accessToken;
        $this->headers['x-3scale-proxy-secret-token'] = 'f93d8a0e4c2c521cf722b3306c99fc033ae479f73b249b1f86722678e368b0f9';
        $this->headers['x-3scale-proxy-access-token'] = $this->accessToken;
        $this->headers['Content-Type'] = 'application/json;charset=UTF-8';
        $this->client = new GuzzleClient(['base_uri' => $baseUrl, 'headers' => $this->headers]);
    }

    public function post($endpoint, $params)
    {
        $response = $this->client->request('POST', $endpoint, ['body' => json_encode($params)]);
        return json_decode($response->getBody());
    }


    /**
     * @param string $accessToken
     *
     * @return Client
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     *
     * @return Client
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }


    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     *
     * @return Client
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }


}