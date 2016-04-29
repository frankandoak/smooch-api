<?php

namespace Smooch;

class AppUser
{
    /** @var Client */
    protected $client;

    /** @var Conversation */
    public $conversation;

    /** @var int|string User ID or Smooch ID */
    public $id = null;

    /**
     * @param Client $client
     * @param int $userId
     */
    public function __construct(Client $client, $userId)
    {
        $this->client = $client;
        $this->id = $userId;

        $this->conversation = new Conversation($client, $this);
    }
}