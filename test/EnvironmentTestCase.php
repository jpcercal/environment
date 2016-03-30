<?php

namespace Cekurte\Environment\Test;

use Cekurte\Environment\Environment;
use Cekurte\Tdd\ReflectionTestCase;

class EnvironmentTestCase extends ReflectionTestCase
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

    public function getDataProviderResourceTypeBooleanYes()
    {
        return [
            ['FAKE_ENV_KEY', 'YES'],
            ['FAKE_ENV_KEY', 'Yes'],
            ['FAKE_ENV_KEY', 'YEs'],
            ['FAKE_ENV_KEY', 'YeS'],
            ['FAKE_ENV_KEY', 'yES'],
            ['FAKE_ENV_KEY', 'yes'],
        ];
    }

    public function getDataProviderResourceTypeBooleanOn()
    {
        return [
            ['FAKE_ENV_KEY', 'ON'],
            ['FAKE_ENV_KEY', 'On'],
            ['FAKE_ENV_KEY', 'oN'],
            ['FAKE_ENV_KEY', 'on'],
        ];
    }

    public function getDataProviderResourceTypeBooleanNo()
    {
        return [
            ['FAKE_ENV_KEY', 'NO'],
            ['FAKE_ENV_KEY', 'No'],
            ['FAKE_ENV_KEY', 'nO'],
            ['FAKE_ENV_KEY', 'no'],
        ];
    }

    public function getDataProviderResourceTypeBooleanOff()
    {
        return [
            ['FAKE_ENV_KEY', 'OFF'],
            ['FAKE_ENV_KEY', 'Off'],
            ['FAKE_ENV_KEY', 'OFf'],
            ['FAKE_ENV_KEY', 'OfF'],
            ['FAKE_ENV_KEY', 'oFF'],
            ['FAKE_ENV_KEY', 'off'],
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
            ['FAKE_ENV_KEY', ''
                             . '[ ["key1"  =>     "val1    ", -123.00002],'
                             . ' [    ["val2"] , 2 ], [ [  [["val3",],]],true], "true"]'],
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
}
