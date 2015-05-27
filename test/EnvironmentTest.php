<?php

namespace Cekurte\Environment\Test;

use Cekurte\Environment\Environment;
use Cekurte\Environment\Filter\KeyRegexFilter;
use Cekurte\Environment\Filter\ValueRegexFilter;
use Cekurte\Environment\Test\EnvironmentTestCase;

class EnvironmentTest extends EnvironmentTestCase
{
    /**
     * @dataProvider getDataProviderResourceTypeNull
     */
    public function testGetNull($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertNull(Environment::get($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanTrue
     */
    public function testGetBooleanTrue($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(Environment::get($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanYes
     */
    public function testGetBooleanYes($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(Environment::get($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanOn
     */
    public function testGetBooleanOn($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(Environment::get($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanFalse
     */
    public function testGetBooleanFalse($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertFalse(Environment::get($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanNo
     */
    public function testGetBooleanNo($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertFalse(Environment::get($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanOff
     */
    public function testGetBooleanOff($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertFalse(Environment::get($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeNumericInt
     */
    public function testGetNumericInt($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(is_int(Environment::get($key)));
    }

    /**
     * @dataProvider getDataProviderResourceTypeNumericFloat
     */
    public function testGetNumericFloat($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(is_float(Environment::get($key)));
    }

    /**
     * @dataProvider getDataProviderResourceTypeArray
     */
    public function testGetArray($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(is_array(Environment::get($key)));
    }

    /**
     * @dataProvider getDataProviderResourceTypeArrayMulti
     */
    public function testGetArrayMulti($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(is_array(Environment::get($key)));
    }

    /**
     * @dataProvider getDataProviderResourceTypeArrayMultiBoolean
     */
    public function testGetArrayMultiBoolean($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $data = Environment::get($key);

        foreach ($data[0] as $item) {
            $this->assertTrue(is_bool($item));
        }
    }

    /**
     * @dataProvider getDataProviderResourceTypeArrayMultiInt
     */
    public function testGetArrayMultiInt($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $data = Environment::get($key);

        foreach ($data[0] as $item) {
            $this->assertTrue(is_int($item));
        }
    }

    /**
     * @dataProvider getDataProviderResourceTypeArrayMultiFloat
     */
    public function testGetArrayMultiFloat($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $data = Environment::get($key);

        foreach ($data[0] as $item) {
            $this->assertTrue(is_float($item));
        }
    }

    /**
     * @dataProvider getDataProviderResourceTypeJson
     */
    public function testGetJson($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(is_array(Environment::get($key)));
    }

    /**
     * @dataProvider getDataProviderResourceTypeUnknown
     */
    public function testGetUnknown($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertEquals($value, Environment::get($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypesReturnDefault
     */
    public function testGetEnvDefaultData($key, $value)
    {
        $this->assertEquals($value, Environment::get($key . 'ENVIRONMENT_TEST', $value));
    }

    public function testGetEnvIgnoringDefaultData()
    {
        $this->assertTrue(is_null(Environment::get('ENVIRONMENT_TEST')));

        putenv('ENVIRONMENT_TEST=1');

        $this->assertTrue(is_int(Environment::get('ENVIRONMENT_TEST', 2)));

        $this->assertEquals(1, Environment::get('ENVIRONMENT_TEST', 2));
    }

    public function testGetEnvironmentVariable()
    {
        putenv('putenv=true');
        $this->assertEquals(true, Environment::get('putenv'));

        $_ENV['_ENV'] = 'true';
        $this->assertEquals(true, Environment::get('_ENV'));

        $_SERVER['_SERVER'] = 'true';
        $this->assertEquals(true, Environment::get('_SERVER'));
    }

    public function testGetAll()
    {
        $_ENV['_ENV'] = 'true';
        $_SERVER['_SERVER'] = 'true';

        $this->assertTrue(is_array(Environment::getAll()));
    }

    public function testGetAllWithKeyRegexFilter()
    {
        $_ENV['_ENV'] = 'true';
        $_ENV['FAKE'] = 'fake';
        $_SERVER['_SERVER'] = 'true';

        $result = Environment::getAll([
            new KeyRegexFilter('/_ENV/'),
        ]);

        $this->assertTrue(is_array($result));

        $this->assertEquals(true, $result['_ENV']);
    }

    public function testGetAllWithValueRegexFilter()
    {
        $_ENV['_ENV'] = 'true';
        $_ENV['FAKE'] = 'fake';
        $_SERVER['_SERVER'] = 'true';

        $result = Environment::getAll([
            new ValueRegexFilter('/true/'),
        ]);

        $this->assertTrue(is_array($result));

        $this->assertEquals(true, $result['_ENV']);
        $this->assertEquals(true, $result['_SERVER']);
    }

    public function testGetAllWithKeyAndValueRegexFilter()
    {
        $_ENV['_ENV'] = 'true';
        $_ENV['FAKE'] = 'fake';
        $_SERVER['_SERVER'] = 'true';

        $result = Environment::getAll([
            new KeyRegexFilter('/FAKE/'),
            new ValueRegexFilter('/fake/'),
        ]);

        $this->assertTrue(is_array($result));

        $this->assertEquals('fake', $result['FAKE']);
    }

    /**
     * @expectedException \Cekurte\Environment\Exception\FilterException
     */
    public function testGetAllFilterException()
    {
        Environment::getAll([
            new \ArrayObject(),
        ]);
    }
}
