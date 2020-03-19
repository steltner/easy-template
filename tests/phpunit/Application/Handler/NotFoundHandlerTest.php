<?php declare(strict_types=1);

namespace Application\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class NotFoundHandlerTest extends TestCase
{
    public function testResponse()
    {
        $handler = new NotFoundHandler();

        $response = $handler->handle($this->prophesize(ServerRequestInterface::class)->reveal());

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(404, $response->getStatusCode());
    }
}
