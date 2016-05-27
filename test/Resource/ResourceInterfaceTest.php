<?php

namespace Cekurte\Environment\Test\Resource;

class ResourceInterfaceTest extends \PHPUnit_Framework_TestCase
{
    public function testIsInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Contract\\ResourceInterface'
        );

        $this->assertTrue($reflection->isInterface());
    }

    public function testHasMethods()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Contract\\ResourceInterface'
        );

        $this->assertTrue($reflection->hasMethod('setResource'));

        $this->assertTrue($reflection->hasMethod('getResource'));

        $this->assertTrue($reflection->hasMethod('process'));
    }
}
