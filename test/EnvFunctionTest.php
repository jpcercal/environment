<?php

namespace Cekurte\Environment\Test;

use function Cekurte\Environment\env;
use Cekurte\Environment\Test\EnvironmentTestCase;

class EnvironmentFunctionTest extends EnvironmentTestCase
{
    /**
     * @dataProvider getDataProviderResourceTypeNull
     */
    public function testGetNull($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertNull(env($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanTrue
     */
    public function testGetBooleanTrue($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(env($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanYes
     */
    public function testGetBooleanYes($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(env($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanOn
     */
    public function testGetBooleanOn($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(env($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanFalse
     */
    public function testGetBooleanFalse($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertFalse(env($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanNo
     */
    public function testGetBooleanNo($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertFalse(env($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeBooleanOff
     */
    public function testGetBooleanOff($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertFalse(env($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypeNumericInt
     */
    public function testGetNumericInt($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(is_int(env($key)));
    }

    /**
     * @dataProvider getDataProviderResourceTypeNumericFloat
     */
    public function testGetNumericFloat($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(is_float(env($key)));
    }

    /**
     * @dataProvider getDataProviderResourceTypeArray
     */
    public function testGetArray($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(is_array(env($key)));
    }

    /**
     * @dataProvider getDataProviderResourceTypeArrayMulti
     */
    public function testGetArrayMulti($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertTrue(is_array(env($key)));
    }

    /**
     * @dataProvider getDataProviderResourceTypeArrayMultiBoolean
     */
    public function testGetArrayMultiBoolean($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $data = env($key);

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

        $data = env($key);

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

        $data = env($key);

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

        $this->assertTrue(is_array(env($key)));
    }

    /**
     * @dataProvider getDataProviderResourceTypeUnknown
     */
    public function testGetUnknown($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        $this->assertEquals($value, env($key));
    }

    /**
     * @dataProvider getDataProviderResourceTypesReturnDefault
     */
    public function testGetEnvDefaultData($key, $value)
    {
        $this->assertEquals($value, env($key . 'ENVIRONMENT_FUNCTION_TEST', $value));
    }

    public function testGetEnvIgnoringDefaultData()
    {
        $this->assertTrue(is_null(env('ENVIRONMENT_FUNCTION_TEST')));

        putenv('ENVIRONMENT_FUNCTION_TEST=1');

        $this->assertTrue(is_int(env('ENVIRONMENT_FUNCTION_TEST', 2)));

        $this->assertEquals(1, env('ENVIRONMENT_FUNCTION_TEST', 2));
    }

    public function testGetEnvironmentVariable()
    {
        putenv('putenv=true');
        $this->assertEquals(true, env('putenv'));

        $_ENV['_ENV'] = 'true';
        $this->assertEquals(true, env('_ENV'));

        $_SERVER['_SERVER'] = 'true';
        $this->assertEquals(true, env('_SERVER'));
    }
}
