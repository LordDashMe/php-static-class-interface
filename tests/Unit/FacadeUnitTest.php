<?php

namespace LordDashMe\StaticClassInterface\Tests\Unit;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use LordDashMe\StaticClassInterface\Facade;

class FacadeUnitTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_facade_class()
    {
        $this->assertInstanceOf(Facade::class, new Facade());
    }

    /**
     * @test
     * @expectedException LordDashMe\StaticClassInterface\Exception\StaticClassAccessor
     * @expectedExceptionCode 100
     */
    public function it_should_throw_exception_invalid_static_class_accessor_when_get_static_class_accessor_not_declared()
    {
        \LordDashMe\StaticClassInterface\Tests\Unit\MockFacadeServiceClassNoGetStaticClassAccssorDeclared::test();
    }

    /**
     * @test
     * @expectedException LordDashMe\StaticClassInterface\Exception\ClassNamespaceResolver
     * @expectedExceptionCode 100
     */
    public function it_should_throw_exception_invalid_service_instance_when_the_given_class_namespace_is_not_set()
    {
        \LordDashMe\StaticClassInterface\Tests\Unit\MockFacadeServiceClassNotValidServiceClassNamespace::test();   
    }

    /**
     * @test
     */
    public function it_should_allow_to_declare_a_function_in_a_static_way()
    {
        $test = \LordDashMe\StaticClassInterface\Tests\Unit\MockFacadeService::test();
        $on_way = \LordDashMe\StaticClassInterface\Tests\Unit\MockFacadeService::giveWay();

        $this->assertTrue($test);
        $this->assertEquals('On way!', $on_way);
    }
}

class MockFacadeServiceClassNoGetStaticClassAccssorDeclared extends Facade 
{

}

class MockFacadeServiceClassNotValidServiceClassNamespace extends Facade
{
    public static function getStaticClassAccessor()
    {
        return '\LordDashMe\StaticClassInterface\Tests\Unit\MockServiceClassNotValid';
    }
}

class MockServiceClass
{
    public function test()
    {
        return true; 
    }

    public function giveWay()
    {
        return 'On way!';
    }
}

class MockFacadeService extends Facade
{
    public static function getStaticClassAccessor()
    {
        return '\LordDashMe\StaticClassInterface\Tests\Unit\MockServiceClass';
    }
}