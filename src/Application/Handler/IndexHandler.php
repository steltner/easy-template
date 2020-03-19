<?php declare(strict_types=1);

namespace Application\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class IndexHandler implements RequestHandlerInterface
{
    /** @var bool */
    private $development;

    public function __construct(bool $development = false)
    {
        $this->development = $development;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(
            [
                'message' => 'You have successfully installed gestes template based on laminas mezzio',
                'development' => $this->development,
            ]
        );
    }
}
