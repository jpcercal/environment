<?php

namespace Cekurte\Environment\Test\Resource;

use Cekurte\Environment\Resource\NullResource;

class NullResourceTest extends \PHPUnit_Framework_TestCase
{
    public function testExtendsResourceAbstract()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Resource\\NullResource'
        );

        $this->assertTrue($reflection->isSubclassOf(
            '\\Cekurte\\Environment\\Resource\\AbstractResource'
        ));
    }

    public function testImplementsResourceInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Resource\\NullResource'
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
        (new NullResource('fake'))->process();
    }
}
