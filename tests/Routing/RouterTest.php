<?php
namespace App\Tests\Routing;

use App\Routing\Router;
use App\Routing\Route;
use App\Routing\Attribute\Route as RouteAttribute;
use App\Routing\Exception\RouteNotFoundException;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class RouterTest extends TestCase
{
    public function testAddRoute()
    {
        $router = new Router($this->createMock(ContainerInterface::class));

        $route = new Route('/products/list', 'products_list', 'GET', 'App\Controller\ProductController', 'list');

        $router->addRoute($route);

        $this->assertSame([$route], $router->getRoutes());
    }

    public function testGetRoute()
    {
        $router = new Router($this->createMock(ContainerInterface::class));

        $route = new Route('/products/list', 'products_list', 'GET', 'App\Controller\ProductController', 'list');

        $router->addRoute($route);

        $foundRoute = $router->getRoute('/products/list', 'GET');

        $this->assertSame($route, $foundRoute);
    }

    public function testExecuteValidRoute()
    {
        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects($this->any())
            ->method('get')
            ->willReturn(new \stdClass());

        $router = new Router($containerMock);

        $route = new Route('/products/list', 'products_list', 'GET', 'App\Controller\ProductController', 'list');

        $router->addRoute($route);

        $response = $router->execute('/products/list', 'GET');

        $this->assertEquals('Ca marche', $response); 
    }

    public function testExecuteInvalidRoute()
    {
        $this->expectException(RouteNotFoundException::class);

        $router = new Router($this->createMock(ContainerInterface::class));

        $router->execute('/nonexistent', 'GET');
    }
}
