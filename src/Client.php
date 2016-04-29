<?php

namespace Smooch;

class Client
{
    /** @var string secret key generated in the Smooch dashboard */
    protected $secret;

    /** @var string key id generated in Smooch dashboard */
    protected $kid;

    /** @var string (app|appUser) claim which specifies the caller’s scope of access */
    protected $scope;

    /** @var string the algorithm used to sign the JWT */
    protected $alg;

    /** @var string type header parameter */
    protected $typ;

    /** @var string base URI of Smooch API */
    protected $baseUri = 'https://api.smooch.io/v1';

    /**
     * Set the credentials used by the client to communicate with Smooch API
     *
     * @param string $secret secret key generated in the Smooch dashboard
     * @param string $kid key id generated in Smooch dashboard
     * @param string $scope (app|appUser) claim which specifies the caller’s scope of access
     * @param string $alg the algorithm used to sign the JWT
     * @param string $typ type header parameter
     */
    public function setCredentials($secret, $kid, $scope = 'app', $alg = 'HS256', $typ = 'JWT')
    {
        $this->secret = $secret;
        $this->kid = $kid;
        $this->scope = $scope;
        $this->alg = $alg;
        $this->typ = $typ;
    }

    /**
     * Returns a new instance of AppUser
     *
     * @param int|string $userId User ID or Smooch ID
     * @return AppUser
     */
    public function getAppUser($userId)
    {
        return new AppUser($this, $userId);
    }

    /**
     * Sign and Process the request to Smooch API
     *
     * @param string $url URL endpoint of given request
     * @param string $method (POST|GET|DELETE|PUT)
     * @param array|null $data payload to be sent to endpoint
     * @return string json returned by Smooch
     */
    public function request($url, $method, $data = null)
    {
        $header = array(
            "alg" => $this->alg,
            "typ" => $this->typ,
            "kid" => $this->kid
        );

        $bearer = \Firebase\JWT\JWT::encode(
            array('scope' => $this->scope),
            $this->secret,
            $this->alg,
            $this->kid,
            $header
        );

        $config = array(
            'request.options' => array(
                'headers' => array(
                        'Authorization' => 'Bearer ' . $bearer,
                        'Content-Type' => 'application/json'
                    ) + $header
            )
        );

        if (($method == 'POST' || $method == 'PUT') && !empty($data)) {
            $json = json_encode($data);
            $config['request.options']['headers']['Content-Length'] = strlen($json);
            $config['request.options']['body'] = $json;
        }

        $client = new \Guzzle\Http\Client($this->baseUri . $url, $config);
        $request = $client->{$method}();
        $response = $request->send();

        return $response->json();
    }
}