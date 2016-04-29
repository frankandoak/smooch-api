[![Build Status](https://travis-ci.org/frankandoak/smooch-api.svg?branch=master)](https://travis-ci.org/frankandoak/smooch-api)

# Smooch API Client
A library to handle Smooch REST API methods
conform to [current spec](http://docs.smooch.io/rest/)

## Installation
Use composer to manage your dependencies and download Smooch API Client:

```bash
composer require frankandoak/smooch-api
```

## Usage
```php
       $message = new Smooch\Model\Message([
           'text' => 'MESSAGE_CONTENT',
           'role' => 'appMaker'
       ]);

       $smoochClient = new Smooch\Client();
       $smoochClient->setCredentials('SECRET', 'KEY_ID');

       $smoochClient
           ->getAppUser('USER_ID_OR_SMOOCH_ID')
           ->conversation
           ->add($message);
```
