<?php

namespace Cekurte\Environment\Test\Resource;

use Cekurte\Environment\Resource\ArrayResource;
use Cekurte\Tdd\ReflectionTestCase;

class ArrayResourceTest extends ReflectionTestCase
{
    public function testExtendsResourceAbstract()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Resource\\ArrayResource'
        );

        $this->assertTrue($reflection->isSubclassOf(
            '\\Cekurte\\Environment\\Resource\\AbstractResource'
        ));
    }

    public function testImplementsResourceInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Environment\\Resource\\ArrayResource'
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
        (new ArrayResource('fake'))->process();
    }

    public function testRemoveChar()
    {
        $mock = $this
            ->getMockBuilder('\\Cekurte\\Environment\\Resource\\ArrayResource')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->assertEquals('[fake]', $this->invokeMethod($mock, 'removeChar', [
            '[fake]'
        ]));

        $this->assertEquals('fake]', $this->invokeMethod($mock, 'removeChar', [
            '[fake]', '['
        ]));

        $this->assertEquals('[fake', $this->invokeMethod($mock, 'removeChar', [
            '[fake]', null, ']'
        ]));

        $this->assertEquals('fake', $this->invokeMethod($mock, 'removeChar', [
            '[fake]', '[', ']'
        ]));

        $this->assertEquals('fake]', $this->invokeMethod($mock, 'removeChar', [
            '[fake]', ['[', 'other']
        ]));

        $this->assertEquals('[fake', $this->invokeMethod($mock, 'removeChar', [
            '[fake]', null, [']', 'other']
        ]));

        $this->assertEquals('fake', $this->invokeMethod($mock, 'removeChar', [
            '[fake]', ['other', '['], ['other', ']']
        ]));
    }

    /**
     * @expectedException        \Cekurte\Environment\Exception\ResourceException
     * @expectedExceptionMessage 1: "message" in file on line 0
     */
    public function testHandleError()
    {
        $mock = $this
            ->getMockBuilder('\\Cekurte\\Environment\\Resource\\ArrayResource')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->invokeMethod($mock, 'handleError', [1, 'message', 'file', 0]);
    }

    public function testItemIsSerialized()
    {
        $mock = $this
            ->getMockBuilder('\\Cekurte\\Environment\\Resource\\ArrayResource')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->assertTrue($this->invokeMethod($mock, 'itemIsSerialized', [serialize(['fake'])]));
        $this->assertTrue($this->invokeMethod($mock, 'itemIsSerialized', [serialize('fake')]));
        $this->assertFalse($this->invokeMethod($mock, 'itemIsSerialized', [serialize(1)]));
        $this->assertFalse($this->invokeMethod($mock, 'itemIsSerialized', [' a:']));
        $this->assertFalse($this->invokeMethod($mock, 'itemIsSerialized', [' s:']));
    }

    public function testFilterItemsEmpty()
    {
        $mock = $this
            ->getMockBuilder('\\Cekurte\\Environment\\Resource\\ArrayResource')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $result = $this->invokeMethod($mock, 'filterItems', [[' ']]);

        $this->assertTrue(count($result) === 0);
    }

    public function testFilterItemsUnserialize()
    {
        $mock = $this
            ->getMockBuilder('\\Cekurte\\Environment\\Resource\\ArrayResource')
            ->disableOriginalConstructor()
            ->setMethods(['removeChar', 'itemIsSerialized'])
            ->getMock()
        ;

        $mock
            ->expects($this->once())
            ->method('removeChar')
            ->will($this->returnValue(serialize('fake')))
        ;

        $mock
            ->expects($this->once())
            ->method('itemIsSerialized')
            ->will($this->returnValue(true))
        ;

        $result = $this->invokeMethod($mock, 'filterItems', [[1]]);

        $this->assertEquals('fake', $result[0]);
    }

    public function testFilterItem()
    {
        $mock = $this
            ->getMockBuilder('\\Cekurte\\Environment\\Resource\\ArrayResource')
            ->disableOriginalConstructor()
            ->setMethods(['removeChar', 'itemIsSerialized'])
            ->getMock()
        ;

        $mock
            ->expects($this->exactly(2))
            ->method('removeChar')
            ->will($this->returnValue('123'))
        ;

        $mock
            ->expects($this->once())
            ->method('itemIsSerialized')
            ->will($this->returnValue(false))
        ;

        $result = $this->invokeMethod($mock, 'filterItems', [[1]]);

        $this->assertEquals('123', $result[0]);
    }

    public function testFilterItemWithKey()
    {
        $mock = $this
            ->getMockBuilder('\\Cekurte\\Environment\\Resource\\ArrayResource')
            ->disableOriginalConstructor()
            ->setMethods(['itemIsSerialized'])
            ->getMock()
        ;

        $mock
            ->expects($this->once())
            ->method('itemIsSerialized')
            ->will($this->returnValue(false))
        ;

        $result = $this->invokeMethod($mock, 'filterItems', [['"key"     => "value"']]);

        $this->assertEquals('value', $result['key']);
    }
}
