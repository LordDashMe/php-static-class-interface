<?php

namespace LordDashMe\StaticClassInterface\Tests\Unit;

use PHPUnit\Framework\TestCase;
use LordDashMe\StaticClassInterface\Facade;

class FacadeTest extends TestCase
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
     */
    public function it_should_throw_exception_static_class_accessor_when_get_static_class_accessor_method_is_not_declared()
    {
        $this->expectException(\LordDashMe\StaticClassInterface\Exception\StaticClassAccessor::class);
        $this->expectExceptionCode(1);
        $this->expectExceptionMessage('The "getStaticClassAccessor()" method is not declared by the successor class.');

        TheGetStaticClassAccssorIsNotDeclared::test();
    }

    /**
     * @test
     */
    public function it_should_throw_exception_class_namespace_resolver_when_the_given_class_namespace_is_not_exist()
    {
        $this->expectException(\LordDashMe\StaticClassInterface\Exception\ClassNamespaceResolver::class);
        $this->expectExceptionCode(1);
        $this->expectExceptionMessage('The class namespace is not exist and can not be resolved.');

        TheServiceClassNamespaceIsNotExist::test();   
    }

    /**
     * @test
     */
    public function it_should_throw_exception_class_namespace_resolver_when_the_given_class_namespace_is_not_string()
    {
        $this->expectException(\LordDashMe\StaticClassInterface\Exception\ClassNamespaceResolver::class);
        $this->expectExceptionCode(2);
        $this->expectExceptionMessage('The given class namespace value is not a string and can not be resolved.');

        TheServiceClassNamespaceIsNotString::test();   
    }

    /**
     * @test
     */
    public function it_should_use_the_service_class_in_a_static_way_with_backslash_in_class_namespace()
    {
        $this->assertEquals('Hello, World!', MockFacadeServiceWithBackSlash::helloWorld());
        $this->assertEquals('A warm welcome for you.', MockFacadeServiceWithBackSlash::warmWelcome());
    }

    /**
     * @test
     */
    public function it_should_use_the_service_class_in_a_static_way_without_backslash_in_class_namespace()
    {
        $this->assertEquals('Hello, World!', MockFacadeServiceWithoutBackSlash::helloWorld());
        $this->assertEquals('A warm welcome for you.', MockFacadeServiceWithoutBackSlash::warmWelcome());
    }
}

class TheGetStaticClassAccssorIsNotDeclared extends Facade {}

class TheServiceClassNamespaceIsNotExist extends Facade
{
    public static function getStaticClassAccessor()
    {
        return '\MockServiceClassNotExist';
    }
}

class TheServiceClassNamespaceIsNotString extends Facade
{
    public static function getStaticClassAccessor()
    {
        return null;
    }
}

class MockServiceClass
{
    public function helloWorld()
    {
        return 'Hello, World!';
    }

    public function warmWelcome()
    {
        return 'A warm welcome for you.';
    }
}

class MockFacadeServiceWithBackSlash extends Facade
{
    protected static function getStaticClassAccessor()
    {
        return '\LordDashMe\StaticClassInterface\Tests\Unit\MockServiceClass';
    }
}

class MockFacadeServiceWithoutBackSlash extends Facade
{
    protected static function getStaticClassAccessor()
    {
        return 'LordDashMe\StaticClassInterface\Tests\Unit\MockServiceClass';
    }
}