<?php

namespace Smooch;

abstract class AbstractClient extends AbstractCredentials
{
    /** @var string base URI of Smooch API */
    private $baseUri = 'https://api.smooch.io/v1';

    /**
     * Defines Smooch API base URI
     *
     * @param string $uri
     * @return $this
     */
    public function setBaseUri($uri)
    {
        $this->baseUri = $uri;
        return $this;
    }

    /**
     * Returns Smooch API base URI
     *
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * Sign and Process the request to Smooch API
     *
     * Will use the credentials set on the factory constructor
     * and payload/uri as defined on methods getCompleteUri()/getPayload() of the concrete class
     *
     * @param string $method (POST|GET|DELETE|PUT)
     * @return string json object returned by Smooch
     */
    protected function processRequest($method = "GET")
    {
        $header = array(
            "alg" => $this->getAlg(),
            "typ" => $this->getTyp(),
            "kid" => $this->getKid()
        );

        $bearer = \Firebase\JWT\JWT::encode(
            array('scope' => $this->getScope()),
            $this->getSecret(),
            $this->getAlg(),
            $this->getKid(),
            $header
        );

        $config = array(
            'request.options' => array(
                'exceptions' => false,
                'headers' => array(
                        'Authorization' => 'Bearer ' . $bearer,
                        'Content-Type' => 'application/json'
                    ) + $header
            )
        );

        if ($method == 'POST' && $this->getPayload()) {
            $json = json_encode($this->getPayload());
            $config['request.options']['headers']['Content-Length'] = strlen($json);
            $config['request.options']['body'] = $json;
        }

        $client = new \Guzzle\Http\Client($this->getCompleteUri(), $config);
        $request = $client->{$method}();
        $response = $request->send();

        return $response->json();
    }

    /**
     * Returns the complete URI as defined by the concrete class
     *
     * @return string
     */
    abstract public function getCompleteUri();

    /**
     * Returns the payload that should be sent to Smooch API
     *
     * @return array|null
     */
    abstract public function getPayload();
}