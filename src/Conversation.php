<?php

namespace Smooch;

class Conversation
{
    /** @var Client */
    protected $client;

    /** @var AppUser */
    public $appUser;

    /**
     * @param Client $client
     * @param AppUser $appUser
     */
    public function __construct(Client $client, AppUser $appUser)
    {
        $this->client = $client;
        $this->appUser = $appUser;
    }

    /**
     * Creates a message on conversation of given user
     *
     * @param Model\Message $message
     * @return Model\Message
     */
    public function add(Model\Message $message)
    {
        $response = $this->client->request(
            '/appusers/' . $this->appUser->id . '/conversation/messages',
            'POST',
            $message->getPayload()
        );

        return new Model\Message($response['message']);
    }
}