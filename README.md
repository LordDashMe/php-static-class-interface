# PHP Static Class Interface [![Build Status](https://travis-ci.org/LordDashMe/php-static-class-interface.svg?branch=master)](https://travis-ci.org/LordDashMe/php-static-class-interface) [![Coverage Status](https://coveralls.io/repos/github/LordDashMe/php-static-class-interface/badge.svg?branch=master)](https://coveralls.io/github/LordDashMe/php-static-class-interface?branch=master)

- A simple package that convert a service class into a static-like class.

## Requirements

- PHP version from 5.6.* up to latest.

## Install

### via Composer

- Use the command below to install the package via composer.

```txt
composer require lorddashme/php-static-class-interface
```

### via Native Way

- You can also use this package without composer, just clone this repository and include or require the important class.

```php
<?php

include __DIR__ . '/src/Exception/Base.php';
include __DIR__ . '/src/Exception/ClassNamespaceResolver.php';
include __DIR__ . '/src/Exception/StaticClassAccessor.php';
include __DIR__ . '/src/Facade.php';

use LordDashMe\StaticClassInterface\Facade;

```

## Usage

- You can start using the package without any configuration needed. Assuming you installed the package via Composer.

- Create a new class that will be represent as the "Static" class of the "Service" class provided in the ```getStaticClassAccessor()```.

- Below, the simple implementation of the package or Facade class.

```php
<?php

include __DIR__  . '/vendor/autoload.php';

namespace Demo\MyClass;

// Import the main class of the package.
use LordDashMe\StaticClassInterface\Facade;

class ServiceClass
{
    public function testService($context)
    {
        echo 'Hello World ' . $context . '!';
    }
}

class ServiceClassFacade extends Facade
{
    public static function getStaticClassAccessor()
    {
        // The namespace of the Service Class that we will convert
        // into "static" like class.
        return '\Demo\MyClass\ServiceClass';
    }
}

// This is the main Service Class.
$service = new ServiceClass();
$service->testService('ServiceClass'); // echo Hello World ServiceClass!

// And we can now use the Service Class like a "static" class implementation.
ServiceClassFacade::testService('ServiceFacadeClass'); // echo Hello World ServiceFacadeClass!
```
