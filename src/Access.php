<?php
namespace orangeplus\Stitch;

use GuzzleHttp\Client;

/**
 * Class Access
 *
 * Static methods to retrieve an access code and an auth token
 *
 */
class Access
{

    public static function callAuthCode(
        $apiKey,
        $redirectUrl,
        $authUrl = 'https://api-pub.stitchlabs.com/authorize',
        $state = null
    ){

        $query = [
            'response_type' => 'code',
            'client_id'     => $apiKey,
            'redirect_url'  => $redirectUrl
        ];

        if ($state){
            $query['state'] = $state;
        }

        $client = new Client(['query' => $query]);

        $response = $client->get($authUrl);
        die($response);
    }
}