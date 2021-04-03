<?php declare(strict_types=1);

namespace Application;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

abstract class HandlerTestCase extends TestCase
{
    /** @var ServerRequestInterface|MockObject  */
    protected ServerRequestInterface $request;
    /** @var LoggerInterface|MockObject */
    protected LoggerInterface $logger;

    protected RequestHandlerInterface $handler;

    protected function setUp(): void
    {
        $this->request = $this->createMock(ServerRequestInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
    }
}
