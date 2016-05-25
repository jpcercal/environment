<?php

namespace Cekurte\Environment\Test\Resource;

use Cekurte\Environment\Resource\NumericResource;

class NumericResourceTest extends \PHPUnit_Framework_TestCase
{
    public function testExtendsResourceAbstract()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Resource\\NumericResource'
        );

        $this->assertTrue($reflection->isSubclassOf(
            '\\Cekurte\\Environment\\Resource\\AbstractResource'
        ));
    }

    public function testImplementsResourceInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Resource\\NumericResource'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\Environment\\Contract\\ResourceInterface'
        ));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testProcessRuntimeException()
    {
        (new NumericResource('fake'))->process();
    }
}
