# Environment

[![Build Status](https://img.shields.io/travis/jpcercal/environment/master.svg?style=flat-square)](http://travis-ci.org/jpcercal/environment)
[![Coverage Status](https://coveralls.io/repos/jpcercal/environment/badge.svg)](https://coveralls.io/r/jpcercal/environment)
[![Latest Stable Version](https://img.shields.io/packagist/v/cekurte/environment.svg?style=flat-square)](https://packagist.org/packages/cekurte/environment)
[![License](https://img.shields.io/packagist/l/cekurte/environment.svg?style=flat-square)](https://packagist.org/packages/cekurte/environment)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/69cde579-31fa-4b64-a2de-cbd6db49bb75/mini.png)](https://insight.sensiolabs.com/projects/69cde579-31fa-4b64-a2de-cbd6db49bb75)

- A simple library (with all methods covered by php unit tests) to increase the power of your environment variables, **contribute with this project**!

## Installation

The package is available on [Packagist](http://packagist.org/packages/cekurte/environment).
The source files is [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) compatible.
Autoloading is [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) compatible.

```shell
composer require cekurte/environment
```

## Documentation

Setup your variables to PHP with envput("KEY=VALUE"), or use this library to perform this task [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) (we recommended you to use this library).

And now, use our library to get values and increase the power of your environment variables.

```php
<?php

use Cekurte\Environment\Environment;

// ...

$data = Environment::get("YOUR_ENVIRONMENT_KEY");

// ...
```

This command will get the value of the environment variable and will convert values to respective php data type.

Actually are available the following resources to process your environment variables:

- [ArrayResource](https://github.com/jpcercal/environment/blob/master/src/Resource/ArrayResource.php)
- [BooleanResource](https://github.com/jpcercal/environment/blob/master/src/Resource/BooleanResource.php)
- [JsonResource](https://github.com/jpcercal/environment/blob/master/src/Resource/JsonResource.php)
- [NullResource](https://github.com/jpcercal/environment/blob/master/src/Resource/NullResource.php)
- [NumericResource](https://github.com/jpcercal/environment/blob/master/src/Resource/NumericResource.php)
- [UnknownResource](https://github.com/jpcercal/environment/blob/master/src/Resource/UnknownResource.php)

If you liked of this library, give me a *star* **=)**.

Contributing
------------

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Make your changes
4. Run the tests, adding new ones for your own code if necessary (`vendor/bin/phpunit`)
5. Commit your changes (`git commit -am 'Added some feature'`)
6. Push to the branch (`git push origin my-new-feature`)
7. Create new Pull Request
