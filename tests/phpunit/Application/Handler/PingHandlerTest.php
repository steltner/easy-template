<?php declare(strict_types=1);

namespace Application\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class PingHandlerTest extends TestCase
{
    public function testResponse()
    {
        $handler = new PingHandler();

        $response = $handler->handle($this->prophesize(ServerRequestInterface::class)->reveal());

        $json = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertTrue(isset($json['time']));
    }
}
