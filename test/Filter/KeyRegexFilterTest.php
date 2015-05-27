<?php

namespace Cekurte\Environment\Test\Filter;

use Cekurte\Environment\Filter\KeyRegexFilter;
use Cekurte\Tdd\ReflectionTestCase;

class KeyRegexFilterTest extends ReflectionTestCase
{
    public function testConstructor()
    {
        $key = new KeyRegexFilter('/fake/');

        $this->assertEquals('/fake/', $this->propertyGetValue($key, 'regex'));
    }

    /**
     * @expectedException \Cekurte\Environment\Exception\FilterException
     */
    public function testConstructorFilterException()
    {
        new KeyRegexFilter('fake');
    }

    public function testFilter()
    {
        $data = [
            '_ENV_BOOLEAN_TRUE'  => 'true',
            '_ENV_BOOLEAN_FALSE' => 'false',
            'FAKE'               => 'fake',
        ];

        $key = new KeyRegexFilter('/^_ENV/');

        $result = $key->filter($data);

        $this->assertTrue(count($result) === 2);

        $this->assertEquals('true', $result['_ENV_BOOLEAN_TRUE']);
    }
}
