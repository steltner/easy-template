<?php declare(strict_types=1);

namespace Application;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Log\LoggerInterface;

abstract class FactoryTestCase extends TestCase
{
    /** @var ContainerInterface|MockObject */
    protected ContainerInterface $container;
    /** @var LoggerInterface|MockObject */
    protected LoggerInterface $logger;

    /** @var MiddlewareInterface|MockObject */
    protected $factory;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
    }
}
