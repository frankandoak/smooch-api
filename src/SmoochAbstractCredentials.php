<?php

namespace Smooch;

abstract class AbstractCredentials
{
    /** @var string secret key generated in the Smooch dashboard */
    private $secret;

    /** @var string key id generated in Smooch dashboard */
    private $kid;

    /** @var string (app|appUser) claim which specifies the caller’s scope of access */
    private $scope;

    /** @var string the algorithm used to sign the JWT */
    private $alg;

    /** @var string type header parameter */
    private $typ;

    /**
     * @param string $secret secret key generated in the Smooch dashboard
     * @param string $kid key id generated in Smooch dashboard
     * @param string $scope (app|appUser) claim which specifies the caller’s scope of access
     * @param string $alg the algorithm used to sign the JWT
     * @param string $typ type header parameter
     */
    public function __construct($secret, $kid, $scope = 'app', $alg = 'HS256', $typ = 'JWT')
    {
        $this->setSecret($secret);
        $this->setKid($kid);
        $this->setScope($scope);
        $this->setAlg($alg);
        $this->setTyp($typ);
    }

    /**
     * Defines the secret key that should be used when signing the requests to Smooch
     *
     * @param string $secret secret key generated in the Smooch dashboard
     * @return $this
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }

    /**
     * Returns the secret key
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Defines the key id that should be used when signing the requests to Smooch
     *
     * @param string $kid key id generated in Smooch dashboard
     * @return $this
     */
    public function setKid($kid)
    {
        $this->kid = $kid;
        return $this;
    }

    /**
     * Returns the key id
     *
     * @return string
     */
    public function getKid()
    {
        return $this->kid;
    }

    /**
     * Defines the scope claim access
     *
     * @param string $scope (app|appUser)
     * @return $this
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * Returns the scope claim access
     *
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Defines the algorithm used to sign the JWT
     *
     * @param string $alg
     * @return $this
     */
    public function setAlg($alg)
    {
        $this->alg = $alg;
        return $this;
    }

    /**
     * Returns the algorithm used to sign the JWT
     *
     * @return string
     */
    public function getAlg()
    {
        return $this->alg;
    }

    /**
     * Defines the type header parameter
     *
     * @param string $typ
     * @return $this
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;
        return $this;
    }

    /**
     * Returns the type header parameter
     *
     * @return string
     */
    public function getTyp()
    {
        return $this->typ;
    }
}