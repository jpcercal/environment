<?php

namespace Cekurte\Environment\Test\Resource;

use Cekurte\Environment\Resource\JsonResource;

class JsonResourceTest extends \PHPUnit_Framework_TestCase
{
    public function testExtendsResourceAbstract()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Resource\\JsonResource'
        );

        $this->assertTrue($reflection->isSubclassOf(
            '\\Cekurte\\Environment\\Resource\\AbstractResource'
        ));
    }

    public function testImplementsResourceInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Resource\\JsonResource'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\Environment\\Contract\\ResourceInterface'
        ));
    }

    /**
     * @expectedException \Cekurte\Environment\Exception\ResourceException
     */
    public function testProcessRuntimeException()
    {
        (new JsonResource('fake'))->process();
    }

    /**
     * @expectedException \Cekurte\Environment\Exception\ResourceException
     */
    public function testProcessJsonErrorRuntimeException()
    {
        (new JsonResource('{["fake"]}'))->process();
    }
}
