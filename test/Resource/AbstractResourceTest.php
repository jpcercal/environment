<?php

namespace Cekurte\Environment\Test\Resource;

class AbstractResourceTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsResourceInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Resource\\AbstractResource'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\Environment\\Resource\\ResourceInterface'
        ));
    }
}
