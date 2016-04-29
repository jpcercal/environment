# Environment

[![Build Status](https://img.shields.io/travis/cekurte/environment/master.svg?style=square)](http://travis-ci.org/cekurte/environment)
[![Code Climate](https://codeclimate.com/github/jpcercal/environment/badges/gpa.svg)](https://codeclimate.com/github/jpcercal/environment)
[![Coverage Status](https://coveralls.io/repos/github/cekurte/environment/badge.svg?branch=master)](https://coveralls.io/github/cekurte/environment?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/cekurte/environment.svg?style=square)](https://packagist.org/packages/cekurte/environment)
[![License](https://img.shields.io/packagist/l/cekurte/environment.svg?style=square)](https://packagist.org/packages/cekurte/environment)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/69cde579-31fa-4b64-a2de-cbd6db49bb75/mini.png)](https://insight.sensiolabs.com/projects/69cde579-31fa-4b64-a2de-cbd6db49bb75)

- A simple library (with all methods covered by php unit tests) to increase the power of your environment variables, **contribute with this project**!

## Installation

- The package is available on [Packagist](http://packagist.org/packages/cekurte/environment).
- The source files is [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) compatible.
- Autoloading is [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) compatible.

```shell
composer require cekurte/environment
```

## Documentation

Setup your variables to PHP with `putenv("KEY=VALUE")` or put your environment variables into OS directly. Additionally you can use this library to perform this task [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) (we recommend that you use this library).

And now, use our library to get values and increase the power of your environment variables.

```php
<?php

use function Cekurte\Environment\env;        // To get values using a function (requires php >=5.6)
use Cekurte\Environment\Environment;         // To get values using a static class
use Cekurte\Environment\EnvironmentVariable; // To get values using a object

// ...

$data = Environment::get("YOUR_ENVIRONMENT_KEY");

// Getting default data if your environment variable not exists or not is loaded.
$data = Environment::get("APP_DEBUG", true);

// ...
// Other ways to get the values of environment variables.

// Using a object...
$data = (new EnvironmentVariable())->get("YOUR_ENVIRONMENT_KEY", "defaultValue");

// Using a function...
$data = env("YOUR_ENVIRONMENT_KEY", "defaultValue");

// Note that if the second parameter is omitted
// then the return value (if your key not exists) will be null.
```

This command will get the value of the environment variable and will convert values to respective php data type.

Actually are available the following resources to process your environment variables:

- [ArrayResource](https://github.com/jpcercal/environment/blob/master/src/Resource/ArrayResource.php)
- [BooleanResource](https://github.com/jpcercal/environment/blob/master/src/Resource/BooleanResource.php)
- [JsonResource](https://github.com/jpcercal/environment/blob/master/src/Resource/JsonResource.php)
- [NullResource](https://github.com/jpcercal/environment/blob/master/src/Resource/NullResource.php)
- [NumericResource](https://github.com/jpcercal/environment/blob/master/src/Resource/NumericResource.php)
- [UnknownResource](https://github.com/jpcercal/environment/blob/master/src/Resource/UnknownResource.php)

### Examples

In this section you can see the examples to all resource types.

#### ArrayResource

The array resource parse a value from environment variable that is a string to the array php data type. Supposing that there exists an environment variable named "ENV_ARRAY" with the following value **[1,2,3,"key"=>"value"]**.

```bash
export ENV_ARRAY=[1,2,3,"key"=>"value"]
```

When you read this environment variable with our library, then it will convert the data to the correct data type (in this case to array) using the [ArrayResource](https://github.com/jpcercal/environment/blob/master/src/Resource/ArrayResource.php) class.

```php
<?php

// array(4) {
//   [0]=> int(1)
//   [1]=> int(2)
//   [2]=> int(3)
//   ["key"]=> string(5) "value"
// }
var_dump(Cekurte\Environment\Environment::get("ENV_ARRAY"));

```

#### BooleanResource

The boolean resource parse a value from environment variable that is a string to the boolean php data type. Supposing that there exists an environment variable named "ENV_BOOL" with the following value **true**.

```bash
export ENV_BOOL=true
```

When you read this environment variable with our library, then it will convert the data to the correct data type (in this case to boolean) using the [BooleanResource](https://github.com/jpcercal/environment/blob/master/src/Resource/BooleanResource.php) class.

```php
<?php

// bool(true)
var_dump(Cekurte\Environment\Environment::get("ENV_BOOL"));

```

#### JsonResource

The json resource parse a value from environment variable that is a string to the array php data type. Supposing that there exists an environment variable named "ENV_JSON" with the following value **{"key":"value"}**.

```bash
export ENV_JSON={"key":"value"}
```

When you read this environment variable with our library, then it will convert the data to the correct data type (in this case to array) using the [JsonResource](https://github.com/jpcercal/environment/blob/master/src/Resource/JsonResource.php) class.

```php
<?php

// array(1) {
//   ["key"]=> string(5) "value"
// }
var_dump(Cekurte\Environment\Environment::get("ENV_JSON"));

```

#### NullResource

The null resource parse a value from environment variable that is a string to the null php data type. Supposing that there exists an environment variable named "ENV_NULL" with the following value **null**.

```bash
export ENV_NULL=null
```

When you read this environment variable with our library, then it will convert the data to the correct data type (in this case to null) using the [NullResource](https://github.com/jpcercal/environment/blob/master/src/Resource/NullResource.php) class.

```php
<?php

// NULL
var_dump(Cekurte\Environment\Environment::get("ENV_NULL"));
```

#### NumericResource

The numeric resource parse a value from environment variable that is a string to the numeric php data type (an integer or a float). Supposing that there exists an environment variable named "ENV_NUMERIC" with the following value **123**.

```bash
export ENV_NUMERIC=123
```

When you read this environment variable with our library, then it will convert the data to the correct data type (in this case to int) using the [NumericResource](https://github.com/jpcercal/environment/blob/master/src/Resource/NumericResource.php) class.

```php
<?php

// int(123)
var_dump(Cekurte\Environment\Environment::get("ENV_NUMERIC"));
```

#### UnknownResource

The unknown resource no parse the values from environment variable and is used to get values when all resource types can not parse the data. Supposing that there exists an environment variable named "ENV_UNKNOWN" with the following value **"unknown"**.

```bash
export ENV_UNKNOWN="unknown"
```

When you read this environment variable with our library, then it will get the raw value using the [UnknownResource](https://github.com/jpcercal/environment/blob/master/src/Resource/UnknownResource.php) class.

```php
<?php

// string(7) "unknown"
var_dump(Cekurte\Environment\Environment::get("ENV_UNKNOWN"));
```

**If you liked of this library, give me a *star =)*.**

Contributing
------------

1. Give me a star **=)**
1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Make your changes
4. Run the tests, adding new ones for your own code if necessary (`vendor/bin/phpunit`)
5. Commit your changes (`git commit -am 'Added some feature'`)
6. Push to the branch (`git push origin my-new-feature`)
7. Create new Pull Request
