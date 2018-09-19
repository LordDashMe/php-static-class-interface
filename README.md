# PHP Static Class Interface 

A simple package that convert a service class into a static-like class.

[![Latest Stable Version](https://img.shields.io/packagist/v/LordDashMe/php-static-class-interface.svg?style=flat-square)](https://packagist.org/packages/LordDashMe/php-static-class-interface) [![Total Downloads](https://img.shields.io/packagist/dt/lorddashme/php-static-class-interface.svg?style=flat-square&colorB=blue)](https://packagist.org/packages/lorddashme/php-static-class-interface) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/) [![Build Status](https://img.shields.io/travis/LordDashMe/php-static-class-interface/master.svg?style=flat-square)](https://travis-ci.org/LordDashMe/php-static-class-interface) [![Coverage Status](https://img.shields.io/coveralls/LordDashMe/php-static-class-interface/master.svg?style=flat-square)](https://coveralls.io/github/LordDashMe/php-static-class-interface?branch=master)

## Requirement(s)

- PHP version from 5.6.* up to latest.

## Install

### via Composer

- Use the command below to install the package via composer:

```txt
composer require lorddashme/php-static-class-interface
```

### via Native Way

- You can also use this package without composer, just clone this repository and import all the important class:

```php
<?php

include __DIR__ . '/src/Exception/Base.php';
include __DIR__ . '/src/Exception/ClassNamespaceResolver.php';
include __DIR__ . '/src/Exception/StaticClassAccessor.php';
include __DIR__ . '/src/Facade.php';

use LordDashMe\StaticClassInterface\Facade;

class ServiceClassFacade extends Facade 
{
    public static function getStaticClassAccessor()
    {
        return '\Namespace\ServiceClass';
    }
}
```

## Usage

- You can start using the package without any configuration. Assuming the package was installed via Composer.

- Create a new class that will represent as the "Static" class of the "Service" class. 

- Override the ```getStaticClassAccessor()``` and set the namespace of the target "Service" class.

- Below are the simple implementation of the package:

```php
<?php

include __DIR__  . '/vendor/autoload.php';

namespace Demo\MyClass;

// Import the main class of the package.
use LordDashMe\StaticClassInterface\Facade;

// This is the original service class.
class ServiceClass
{
    public function testService($context)
    {
        echo 'Hello World ' . $context . '!';
    }
}

// This is the mimic service class that can now access like static class.
class ServiceClassFacade extends Facade
{
    public static function getStaticClassAccessor()
    {
        // The namespace of the Service Class that will convert
        // into a "static" like class.
        return '\Demo\MyClass\ServiceClass';
    }
}

// This is the Service Class.
$service = new ServiceClass();
$service->testService('ServiceClass'); // echo Hello World ServiceClass!

// And we can now use the Service Class like a "static" class implementation.
ServiceClassFacade::testService('ServiceFacadeClass'); // echo Hello World ServiceFacadeClass!
```

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
