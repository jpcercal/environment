<?php

namespace Cekurte\Environment\Test;

use function Cekurte\Environment\env;
use Cekurte\Environment\Environment;
use Cekurte\Tdd\ReflectionTestCase;

class EnvTest extends ReflectionTestCase
{
    public function getDataProviderResourceTypesReturnDefault()
    {
        return [
            ['FAKE_ENV_KEY_FUNCTION', 'string'],
            ['FAKE_ENV_KEY_FUNCTION', null],
            ['FAKE_ENV_KEY_FUNCTION', true],
            ['FAKE_ENV_KEY_FUNCTION', false],
            ['FAKE_ENV_KEY_FUNCTION', 1],
            ['FAKE_ENV_KEY_FUNCTION', 1.23],
            ['FAKE_ENV_KEY_FUNCTION', []],
        ];
    }

    /**
     * @dataProvider getDataProviderResourceTypesReturnDefault
     */
    public function testGetEnvUsingFunction($key, $value)
    {
        $this->assertEquals($value, \Cekurte\Environment\env($key, $value));
    }

    /**
     * @dataProvider getDataProviderResourceTypesReturnDefault
     */
    public function testGetEnvUsingFunctionAsAlias($key, $value)
    {
        $this->assertEquals($value, env($key, $value));
    }

    public function testGetEnvIgnoringDefaultData()
    {
        $this->assertTrue(is_null(\Cekurte\Environment\env('FAKE_ENV_KEY_FUNCTION')));

        putenv('FAKE_ENV_KEY_FUNCTION=1');

        $this->assertTrue(is_int(\Cekurte\Environment\env('FAKE_ENV_KEY_FUNCTION', 2)));

        $this->assertEquals(1, \Cekurte\Environment\env('FAKE_ENV_KEY_FUNCTION', 2));
    }
}
