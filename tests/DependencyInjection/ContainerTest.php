<?php
// namespace App\Tests\DependencyInjection;

// use App\DependencyInjection\Container;
// use App\DependencyInjection\ServiceNotFoundException;
// use PHPUnit\Framework\TestCase;

// class ContainerTest extends TestCase
// {
//     public function testGetExistingService()
//     {
//         $container = new Container();
//         $serviceInstance = new \stdClass();
//         $container->set('example_service', $serviceInstance);

//         $result = $container->get('example_service');

//         $this->assertSame($serviceInstance, $result);
//     }

//     public function testGetNonexistentService()
//     {
//         $this->expectException(ServiceNotFoundException::class);

//         $container = new Container();
//         $container->get('nonexistent_service');
//     }

//     public function testHasExistingService()
//     {
//         $container = new Container();
//         $container->set('existing_service', new \stdClass());

//         $result = $container->has('existing_service');

//         $this->assertTrue($result);
//     }

//     public function testHasNonexistentService()
//     {
//         $container = new Container();

//         $result = $container->has('nonexistent_service');

//         $this->assertFalse($result);
//     }

//     public function testSetService()
//     {
//         $container = new Container();
//         $serviceInstance = new \stdClass();

//         $container->set('example_service', $serviceInstance);

//         $this->assertTrue($container->has('example_service'));
//         $this->assertSame($serviceInstance, $container->get('example_service'));
//     }

// }
