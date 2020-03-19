<?php declare(strict_types=1);

namespace Application\Handler;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class IndexHandlerFactoryTest extends TestCase
{
    public function testFactory()
    {
        $container = $this->prophesize(ContainerInterface::class);

        $factory = new IndexHandlerFactory();

        $response = $factory($container->reveal());

        $this->assertInstanceOf(IndexHandler::class, $response);
    }
}
