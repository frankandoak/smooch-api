<?php

namespace Smooch;

class Factory extends AbstractCredentials
{
    /**
     * Creates a new instance of the Message class
     * The message class can be used to post new messages to an user on Smooch
     *
     * @return Message
     */
    public function buildMessage()
    {
        return new Message($this->getSecret(), $this->getKid(), $this->getScope(), $this->getAlg(), $this->getTyp());
    }
}