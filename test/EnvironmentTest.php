<?php

namespace Cekurte\Environment\Test;

use Cekurte\Environment\Environment;
use Cekurte\Tdd\ReflectionTestCase;

class EnvironmentTest extends ReflectionTestCase
{
    public function getDataProviderResourceTypeNull()
    {
        return [
            ['FAKE_ENV_KEY', 'NULL'],
            ['FAKE_ENV_KEY', 'Null'],
            ['FAKE_ENV_KEY', 'nuLL'],
            ['FAKE_ENV_KEY', 'nulL'],
            ['FAKE_ENV_KEY', 'nUlL'],
            ['FAKE_ENV_KEY', 'null'],
        ];
    }

    public function getDataProviderResourceTypeBooleanTrue()
    {
        return [
            ['FAKE_ENV_KEY', 'TRUE'],
            ['FAKE_ENV_KEY', 'True'],
            ['FAKE_ENV_KEY', 'trUE'],
            ['FAKE_ENV_KEY', 'truE'],
            ['FAKE_ENV_KEY', 'tRUe'],
            ['FAKE_ENV_KEY', 'true'],
        ];
    }

    public function getDataProviderResourceTypeBooleanFalse()
    {
        return [
            ['FAKE_ENV_KEY', 'FALSE'],
            ['FAKE_ENV_KEY', 'False'],
            ['FAKE_ENV_KEY', 'falSE'],
            ['FAKE_ENV_KEY', 'falsE'],
            ['FAKE_ENV_KEY', 'fALSe'],
            ['FAKE_ENV_KEY', 'false'],
        ];
    }

    public function getDataProviderResourceTypeNumericInt()
    {
        return [
            ['FAKE_ENV_KEY', '1'],
            ['FAKE_ENV_KEY', '123'],
            ['FAKE_ENV_KEY', '123456'],
            ['FAKE_ENV_KEY', '123456789'],
            ['FAKE_ENV_KEY', '-321'],
        ];
    }

    public function getDataProviderResourceTypeNumericFloat()
    {
        return [
            ['FAKE_ENV_KEY', '1.01'],
            ['FAKE_ENV_KEY', '123.123'],
            ['FAKE_ENV_KEY', '123456.1'],
            ['FAKE_ENV_KEY', '123456789.000000002'],
            ['FAKE_ENV_KEY', '-321.0012'],
        ];
    }

    public function getDataProviderResourceTypeArray()
    {
        return [
            ['FAKE_ENV_KEY', '[]'],
            ['FAKE_ENV_KEY', '["val1", "val2"]'],
            ['FAKE_ENV_KEY', '[true, false, TRUE, FALSE]'],
            ['FAKE_ENV_KEY', '[NULL, "null"]'],
            ['FAKE_ENV_KEY', '[-321.0012,123,0,]'],
            ['FAKE_ENV_KEY', '[\'String1\',"True",   "string2"]'],
            ['FAKE_ENV_KEY', '[  "String1"   ,   "String2"  ,]'],
            ['FAKE_ENV_KEY', '[  "String1"   ,   "String2"  , ]'],
            ['FAKE_ENV_KEY', '[  " String1  "   ,   " String2"  , "String3 " ]'],
        ];
    }

    public function getDataProviderResourceTypeArrayMulti()
    {
        return [
            ['FAKE_ENV_KEY', '[[]]'],
            ['FAKE_ENV_KEY', '[["val1"], ["val2"]]'],
            ['FAKE_ENV_KEY', '[["val1"], [["val2", false], "false"], ["val3"]]'],
            ['FAKE_ENV_KEY', '[ ["key1"  =>     "val1    ", -123.00002], [    ["val2"] , 2 ], [ [  [["val3",],]],true], "true"]'],
        ];
    }

    public function getDataProviderResourceTypeArrayMultiBoolean()
    {
        return [
            ['FAKE_ENV_KEY', '[["false"], [false], ["true"], [true]]'],
            ['FAKE_ENV_KEY', '[["FALSE"], [FALSE], ["TRUE"], [TRUE]]'],
            ['FAKE_ENV_KEY', '[["fALSe"], [fALSe], ["tRUe"], [tRUe]]'],
        ];
    }

    public function getDataProviderResourceTypeArrayMultiInt()
    {
        return [
            ['FAKE_ENV_KEY', '[["123"], [123], ["-123"], [-123]]'],
            ['FAKE_ENV_KEY', '[["0"], [10], ["20"], [30]]'],
        ];
    }

    public function getDataProviderResourceTypeArrayMultiFloat()
    {
        return [
            ['FAKE_ENV_KEY', '[["123.00002"], [123.00002], ["-123.00002"], [-123.00002]]'],
            ['FAKE_ENV_KEY', '[["0.1"], [10.2], ["20.3"], [30.4]]'],
        ];
    }

    public function getDataProviderResourceTypeArrayException()
    {
        return [
            ['FAKE_ENV_KEY', '[]]'],
            ['FAKE_ENV_KEY', '[[]'],
            ['FAKE_ENV_KEY', '["string"=]'],
            ['FAKE_ENV_KEY', '["string"=>]'],
            ['FAKE_ENV_KEY', '["string"=>[]'],
        ];
    }

    public function getDataProviderResourceTypeJson()
    {
        return [
            ['FAKE_ENV_KEY', '{"key": "value"}'],
            ['FAKE_ENV_KEY', '{"numbers": [0,1,2,3,4,5,6,7,8,9]}'],
            ['FAKE_ENV_KEY', '{"values": ["val1", "val2", "val3"]}'],
            ['FAKE_ENV_KEY', '{"values": [["val1", "val2", "val3"], ["val4"]]}'],
        ];
    }

    public function getDataProviderResourceTypeUnknown()
    {
        return [
            ['FAKE_ENV_KEY', 'STRING'],
            ['FAKE_ENV_KEY', 'String'],
            ['FAKE_ENV_KEY', 'string'],
            ['FAKE_ENV_KEY', 'String 55'],
            ['FAKE_ENV_KEY', 'String False'],
            ['FAKE_ENV_KEY', 'String True'],
            ['FAKE_ENV_KEY', '123,21'],

            ['FAKE_ENV_KEY', '#'],
            ['FAKE_ENV_KEY', '$'],
            ['FAKE_ENV_KEY', '!'],
            ['FAKE_ENV_KEY', '?'],
            ['FAKE_ENV_KEY', '+'],
            ['FAKE_ENV_KEY', ':'],
            ['FAKE_ENV_KEY', '~'],
            ['FAKE_ENV_KEY', '^'],
            ['FAKE_ENV_KEY', '['],
            ['FAKE_ENV_KEY', '{'],
            ['FAKE_ENV_KEY', '('],
            ['FAKE_ENV_KEY', ']'],
            ['FAKE_ENV_KEY', '}'],
            ['FAKE_ENV_KEY', ')'],
            ['FAKE_ENV_KEY', '()'],
            ['FAKE_ENV_KEY', ''],

            ['FAKE_ENV_KEY', '#43'],
            ['FAKE_ENV_KEY', '#43.12'],
            ['FAKE_ENV_KEY', '#null'],
            ['FAKE_ENV_KEY', '#true'],
            ['FAKE_ENV_KEY', '#false'],

            ['FAKE_ENV_KEY', '$23'],
            ['FAKE_ENV_KEY', '$23.56'],
            ['FAKE_ENV_KEY', '$null'],
            ['FAKE_ENV_KEY', '$true'],
            ['FAKE_ENV_KEY', '$false'],

            ['FAKE_ENV_KEY', '!23'],
            ['FAKE_ENV_KEY', '!43.12'],
            ['FAKE_ENV_KEY', '!null'],
            ['FAKE_ENV_KEY', '!true'],
            ['FAKE_ENV_KEY', '!false'],

            ['FAKE_ENV_KEY', '?23'],
            ['FAKE_ENV_KEY', '?43.12'],
            ['FAKE_ENV_KEY', '?null'],
            ['FAKE_ENV_KEY', '?true'],
            ['FAKE_ENV_KEY', '?false'],

            ['FAKE_ENV_KEY', '+23'],
            ['FAKE_ENV_KEY', '+43.12'],
            ['FAKE_ENV_KEY', '+null'],
            ['FAKE_ENV_KEY', '+true'],
            ['FAKE_ENV_KEY', '+false'],

            ['FAKE_ENV_KEY', ':23'],
            ['FAKE_ENV_KEY', ':43.12'],
            ['FAKE_ENV_KEY', ':null'],
            ['FAKE_ENV_KEY', ':true'],
            ['FAKE_ENV_KEY', ':false'],

            ['FAKE_ENV_KEY', '~23'],
            ['FAKE_ENV_KEY', '~43.12'],
            ['FAKE_ENV_KEY', '~null'],
            ['FAKE_ENV_KEY', '~true'],
            ['FAKE_ENV_KEY', '~false'],

            ['FAKE_ENV_KEY', '^23'],
            ['FAKE_ENV_KEY', '^43.12'],
            ['FAKE_ENV_KEY', '^null'],
            ['FAKE_ENV_KEY', '^true'],
            ['FAKE_ENV_KEY', '^false'],

            ['FAKE_ENV_KEY', '[23'],
            ['FAKE_ENV_KEY', '[43.12'],
            ['FAKE_ENV_KEY', '[null'],
            ['FAKE_ENV_KEY', '[true'],
            ['FAKE_ENV_KEY', '[false'],

            ['FAKE_ENV_KEY', '{23'],
            ['FAKE_ENV_KEY', '{43.12'],
            ['FAKE_ENV_KEY', '{null'],
            ['FAKE_ENV_KEY', '{true'],
            ['FAKE_ENV_KEY', '{false'],

            ['FAKE_ENV_KEY', '(23'],
            ['FAKE_ENV_KEY', '(43.12'],
            ['FAKE_ENV_KEY', '(null'],
            ['FAKE_ENV_KEY', '(true'],
            ['FAKE_ENV_KEY', '(false'],

            ['FAKE_ENV_KEY', '23]'],
            ['FAKE_ENV_KEY', '43.12]'],
            ['FAKE_ENV_KEY', 'null]'],
            ['FAKE_ENV_KEY', 'true]'],
            ['FAKE_ENV_KEY', 'false]'],

            ['FAKE_ENV_KEY', '23}'],
            ['FAKE_ENV_KEY', '43.12}'],
            ['FAKE_ENV_KEY', 'null}'],
            ['FAKE_ENV_KEY', 'true}'],
            ['FAKE_ENV_KEY', 'false}'],

            ['FAKE_ENV_KEY', '23)'],
            ['FAKE_ENV_KEY', '43.12)'],
            ['FAKE_ENV_KEY', 'null)'],
            ['FAKE_ENV_KEY', 'true)'],
            ['FAKE_ENV_KEY', 'false)'],

            ['FAKE_ENV_KEY', '(23)'],
            ['FAKE_ENV_KEY', '(43.12)'],
            ['FAKE_ENV_KEY', '(null)'],
            ['FAKE_ENV_KEY', '(true)'],
            ['FAKE_ENV_KEY', '(false)'],
        ];
    }

    public function testConstructDisabled()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Environment'
        );

        $this->assertFalse($reflection->getConstructor()->isPublic());
    }

    public function testConstructAccessWithMock()
    {
        $mock = $this->getMockBuilder('\\Cekurte\\Environment\\Environment')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->invokeMethod($mock, '__construct');
    }

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
     * @dataProvider getDataProviderResourceTypeBooleanFalse
     */
    public function testGetBooleanFalse($key, $value)
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
     * @expectedException \UnexpectedValueException
     *
     * @dataProvider getDataProviderResourceTypeArrayException
     */
    public function testGetArrayException($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));

        Environment::get($key);
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

    public function testGetEnvironmentVariable()
    {
        putenv('putenv=true');
        $this->assertEquals(true, Environment::get('putenv'));

        $_ENV['_ENV'] = 'true';
        $this->assertEquals(true, Environment::get('_ENV'));

        $_SERVER['_SERVER'] = 'true';
        $this->assertEquals(true, Environment::get('_SERVER'));
    }
}
