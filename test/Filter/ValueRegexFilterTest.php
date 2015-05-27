<?php

namespace Cekurte\Environment\Test\Filter;

use Cekurte\Environment\Filter\ValueRegexFilter;
use Cekurte\Tdd\ReflectionTestCase;

class ValueRegexFilterTest extends ReflectionTestCase
{
    public function testConstructor()
    {
        $value = new ValueRegexFilter('/fake/');

        $this->assertEquals('/fake/', $this->propertyGetValue($value, 'regex'));
    }

    /**
     * @expectedException \Cekurte\Environment\Exception\FilterException
     */
    public function testConstructorFilterException()
    {
        new ValueRegexFilter('fake');
    }

    public function testFilter()
    {
        $data = [
            '_ENV_BOOLEAN_TRUE'  => 'true',
            '_ENV_BOOLEAN_FALSE' => 'false',
            'FAKE'               => 'fake',
        ];

        $value = new ValueRegexFilter('/^true$/');

        $result = $value->filter($data);

        $this->assertTrue(count($result) === 1);

        $this->assertEquals('true', $result['_ENV_BOOLEAN_TRUE']);
    }
}
