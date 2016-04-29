<?php

namespace Smooch\Model;

class Message
{
    /** @var array */
    private $payload = [];

    /**
     * @param array $payload
     */
    public function __construct(array $payload)
    {
        $this->setPayload($payload);
    }

    /**
     * Set the message id
     *
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->payload['_id'] = $id;
        return $this;
    }

    /**
     * Returns the message id
     *
     * @return null|string
     */
    public function getId()
    {
        return !empty($this->payload['_id']) ? $this->payload['_id'] : null;
    }

    /**
     * Sets the payload of this message
     *
     * @param array $payload
     */
    public function setPayload(array $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Returns the payload associated with this message
     *
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Set the message content
     * It becomes optional if mediaUrl and mediaType are both specified or when actions are provided
     *
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->payload['text'] = $text;
        return $this;
    }

    /**
     * Get the message content
     *
     * @return null|string
     */
    public function getText()
    {
        return !empty($this->payload['text']) ? $this->payload['text'] : null;
    }

    /**
     * Set the role of the individual posting the message
     * Can be either appUser or appMaker
     *
     * @param string $role (appUser|appMaker)
     * @return $this
     */
    public function setRole($role)
    {
        $this->payload['role'] = $role;
        return $this;
    }

    /**
     * Get the role of the individual posting the message
     *
     * @return null|string
     */
    public function getRole()
    {
        return !empty($this->payload['role']) ? $this->payload['role'] : null;
    }

    /**
     * Set the display name of the message author
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->payload['name'] = $name;
        return $this;
    }

    /**
     * Get the display name of the message author
     *
     * @return null|string
     */
    public function getName()
    {
        return !empty($this->payload['name']) ? $this->payload['name'] : null;
    }

    /**
     * Set the email address of the message author
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->payload['email'] = $email;
        return $this;
    }

    /**
     * Get the email address of the message author
     *
     * @return null|string
     */
    public function getEmail()
    {
        return !empty($this->payload['email']) ? $this->payload['email'] : null;
    }

    /**
     * Set the URL of the desired message avatar image
     *
     * @param string $avatarUrl
     * @return $this
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->payload['avatarUrl'] = $avatarUrl;
        return $this;
    }

    /**
     * Get the URL of the desired message avatar image
     *
     * @return null|string
     */
    public function getAvatarUrl()
    {
        return !empty($this->payload['avatarUrl']) ? $this->payload['avatarUrl'] : null;
    }

    /**
     * Set the image URL used in an image message
     *
     * @param string $mediaUrl
     * @return $this
     */
    public function setMediaUrl($mediaUrl)
    {
        $this->payload['mediaUrl'] = $mediaUrl;
        return $this;
    }

    /**
     * Get the image URL used in an image message
     *
     * @return null|string
     */
    public function getMediaUrl()
    {
        return !empty($this->payload['mediaUrl']) ? $this->payload['mediaUrl'] : null;
    }

    /**
     * Set the media type related to the media url assigned to the message
     *
     * @param string $mediaType e.g. image/jpeg
     * @return $this
     */
    public function setMediaType($mediaType)
    {
        $this->payload['mediaType'] = $mediaType;
        return $this;
    }

    /**
     * Get the media type related to the media url assigned to the message
     *
     * @return null|string
     */
    public function getMediaType()
    {
        return !empty($this->payload['mediaType']) ? $this->payload['mediaType'] : null;
    }

    /**
     * Set metadata containing any custom properties associated with the message
     * the media type related to the media url assigned to the message
     *
     * @param string $metadata Should be a Flat JSON object
     * @return $this
     */
    public function setMetadata($metadata)
    {
        $this->payload['metadata'] = $metadata;
        return $this;
    }

    /**
     * Get metadata containing any custom properties associated with the message
     *
     * @return null|string
     */
    public function getMetadata()
    {
        return !empty($this->payload['metadata']) ? $this->payload['metadata'] : null;
    }

    /**
     * Set the array of action buttons assigned to the message
     *
     * @param array $actions
     * @return $this
     */
    public function setActions(array $actions)
    {
        $this->payload['actions'] = $actions;
        return $this;
    }

    /**
     * Get the array of action buttons assigned to the message
     *
     * @return null|array
     */
    public function getActions()
    {
        return !empty($this->payload['actions']) ? $this->payload['actions'] : null;
    }

    /**
     * Add an action to the array of action buttons assigned to the message
     *
     * @param string $text Label of action button
     * @param string $type Type of action, one of (link|buy|postback)
     * @param array $options Options associated to action type
     * @see http://docs.smooch.io/rest/#action-buttons
     * @return $this
     */
    public function addAction($text, $type, array $options)
    {
        $this->payload['actions'][] = [
                'text' => $text,
                'type' => $type
            ] + $options;
        return $this;
    }

    /**
     * Remove an action from the array of action buttons assigned to the message
     *
     * @param int $index Index of action button to be removed
     * @return $this
     */
    public function removeAction(int $index)
    {
        unset($this->payload['actions'][$index]);
        return $this;
    }
}