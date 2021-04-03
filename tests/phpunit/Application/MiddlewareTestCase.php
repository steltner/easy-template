<?php declare(strict_types=1);

namespace Application;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

abstract class MiddlewareTestCase extends TestCase
{
    /** @var ServerRequestInterface|MockObject  */
    protected ServerRequestInterface $request;
    /** @var ResponseInterface|MockObject  */
    protected ResponseInterface $response;
    /** @var RequestHandlerInterface|MockObject  */
    protected RequestHandlerInterface $handler;
    /** @var LoggerInterface|MockObject */
    protected LoggerInterface $logger;

    protected MiddlewareInterface $middleware;

    protected function setUp(): void
    {
        $this->request = $this->createMock(ServerRequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->handler = $this->createMock(RequestHandlerInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
    }
}
