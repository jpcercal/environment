<?php

namespace Cekurte\Environment\Test\Resource;

use Cekurte\Environment\Resource\BooleanResource;

class BooleanResourceTest extends \PHPUnit_Framework_TestCase
{
    public function testExtendsResourceAbstract()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Resource\\BooleanResource'
        );

        $this->assertTrue($reflection->isSubclassOf(
            '\\Cekurte\\Environment\\Resource\\AbstractResource'
        ));
    }

    public function testImplementsResourceInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Resource\\BooleanResource'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\Environment\\Resource\\ResourceInterface'
        ));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testProcessRuntimeException()
    {
        (new BooleanResource('fake'))->process();
    }
}
