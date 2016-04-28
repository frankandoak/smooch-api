Smooch PHP SDK
=======
A library to handle Smooch REST API methods
conform to [current spec](http://docs.smooch.io/rest/)

Installation
------------

Use composer to manage your dependencies and download Smooch PHP SDK:

```bash
composer require frankandoak/smooch
```

Example
-------
```php
<?php
    $smooch = new Smooch\Factory("SECRET", "KEY_ID");
    $smoochMessage = $smooch->buildMessage();

    $jsonResponse = $smoochMessage->setUserId("USER_OR_SMOOCH_ID")
        ->setText('MESSAGE_CONTENT')
        ->setRole('appMaker')
        ->send();
?>
```