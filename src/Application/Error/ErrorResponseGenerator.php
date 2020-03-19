<?php declare(strict_types=1);

namespace Application\Error;

use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Stratigility\Utils;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

use function get_class;
use function is_object;

class ErrorResponseGenerator
{
    /** @var bool */
    private $development;

    public function __construct(bool $development = false)
    {
        $this->development = $development;
    }

    public function __invoke(
        Throwable $exception,
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        if ($this->development) {
            $trace = [];

            foreach ($exception->getTrace() as $frame) {
                $args = [];

                foreach ($frame['args'] as $argument) {
                    $args[] = is_object($argument) ? get_class($argument) : $argument;
                }

                $trace[] = [
                    'file' => $frame['file'],
                    'class' => $frame['class'] ?? null,
                    'function' => $frame['function'],
                    'line' => $frame['line'],
                    'args' => $args,
                ];
            }

            $data = [
                'type' => get_class($exception),
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $trace,
            ];
        } else {
            $data = [
                'type' => get_class($exception),
                'message' => 'Error',
            ];
        }

        return new JsonResponse($data, Utils::getStatusCode($exception, $response));
    }
}
