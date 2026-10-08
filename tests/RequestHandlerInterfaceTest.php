<?php

namespace HttpServerHandler\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Http\Server\RequestHandlerInterface;

class RequestHandlerInterfaceTest extends TestCase
{
    public function testInterfaceIsLoadableFromPsr4()
    {
        $this->assertTrue(interface_exists(RequestHandlerInterface::class));

        $reflection = new \ReflectionClass(RequestHandlerInterface::class);
        $this->assertTrue($reflection->isInterface());
        $this->assertFalse($reflection->isInstantiable());
        $this->assertSame('Psr\\Http\\Server', $reflection->getNamespaceName());
        $this->assertSame('RequestHandlerInterface', $reflection->getShortName());

        $fileName = $reflection->getFileName();
        $this->assertInternalType('string', $fileName);
        $this->assertNotSame('', $fileName);
        $this->assertTrue(is_file($fileName));
        $this->assertRegExp('#/src/RequestHandlerInterface\\.php$#', $fileName);
    }

    public function testInterfaceHasNoParentsOrConstants()
    {
        $reflection = new \ReflectionClass(RequestHandlerInterface::class);
        $this->assertSame(array(), $reflection->getInterfaces());
        $this->assertSame(array(), $reflection->getConstants());
    }

    public function testHandleIsTheOnlyMethod()
    {
        $reflection = new \ReflectionClass(RequestHandlerInterface::class);
        $methods = $reflection->getMethods();

        $this->assertCount(1, $methods);
        $this->assertSame('handle', $methods[0]->getName());
        $this->assertTrue($methods[0]->isPublic());
        $this->assertFalse($methods[0]->isStatic());
        $this->assertTrue($methods[0]->isAbstract());
    }

    public function testHandleParameterContract()
    {
        $reflection = new \ReflectionMethod(RequestHandlerInterface::class, 'handle');
        $this->assertSame(1, $reflection->getNumberOfRequiredParameters());
        $this->assertSame(1, $reflection->getNumberOfParameters());

        $parameter = $reflection->getParameters()[0];
        $this->assertSame('request', $parameter->getName());
        $this->assertTrue($parameter->hasType());
        $this->assertSame('Psr\\Http\\Message\\ServerRequestInterface', (string) $parameter->getType());
        $this->assertFalse($parameter->isOptional());
        $this->assertFalse($parameter->isPassedByReference());
        $this->assertFalse($parameter->isVariadic());
        $this->assertFalse($parameter->isDefaultValueAvailable());

        $class = $parameter->getClass();
        $this->assertInstanceOf(\ReflectionClass::class, $class);
        $this->assertTrue($class->isInterface());
        $this->assertSame('Psr\\Http\\Message\\ServerRequestInterface', $class->getName());
    }

    public function testHandleReturnTypeContract()
    {
        $reflection = new \ReflectionMethod(RequestHandlerInterface::class, 'handle');
        $this->assertTrue($reflection->hasReturnType());

        $returnType = $reflection->getReturnType();
        $this->assertNotNull($returnType);
        $returnTypeName = (string) $returnType;
        $this->assertNotSame('', $returnTypeName);
        $this->assertSame('Psr\\Http\\Message\\ResponseInterface', $returnTypeName);
        $this->assertTrue(interface_exists($returnTypeName));

        $returnTypeReflection = new \ReflectionClass($returnTypeName);
        $this->assertTrue($returnTypeReflection->isInterface());
    }

    public function testConformingHandlerReturnMatchesDeclaredType()
    {
        require_once __DIR__ . '/Double/ResponseDouble.php';
        require_once __DIR__ . '/Double/ServerRequestDouble.php';
        require_once __DIR__ . '/Double/ConformingRequestHandler.php';

        $interfaceMethod = new \ReflectionMethod(RequestHandlerInterface::class, 'handle');
        $returnType = $interfaceMethod->getReturnType();
        $this->assertNotNull($returnType);
        $returnTypeName = (string) $returnType;
        $this->assertNotSame('', $returnTypeName);
        $this->assertTrue(interface_exists($returnTypeName));

        $handler = new Double\ConformingRequestHandler();
        $this->assertInstanceOf(RequestHandlerInterface::class, $handler);

        $response = $handler->handle(new Double\ServerRequestDouble());
        $this->assertInstanceOf($returnTypeName, $response);
    }
}
