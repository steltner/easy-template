<?php declare(strict_types=1);

namespace Application\Error;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

use function array_walk_recursive;
use function get_class;
use function is_array;
use function is_numeric;
use function is_object;
use function is_string;

class ErrorResponseGenerator
{
    public function __construct(private bool $development = false)
    {
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

                if (isset($frame['args'])) {
                    foreach ($frame['args'] as $argument) {
                        $args[] = is_object($argument) ? get_class($argument) : $argument;
                    }
                }

                $trace[] = [
                    'file' => $frame['file'] ?? null,
                    'class' => $frame['class'] ?? null,
                    'function' => $frame['function'] ?? null,
                    'line' => $frame['line'] ?? null,
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

            $data = $this->utf8Encode($data);
        } else {
            $data = [
                'type' => get_class($exception),
                'message' => 'Error',
            ];
        }

        return new JsonResponse($data, $this->getStatusCode($exception, $response));
    }

    private function utf8Encode(array $data): array
    {
        foreach ($data['trace'] as &$step) {
            if (isset($step['args'])) {
                array_walk_recursive(
                    $step['args'],
                    function (&$entry) {
                        $entry = is_string($entry) || is_array($entry) ? mb_convert_encoding($entry, 'UTF-8') : $entry;
                    }
                );
            }
        }

        return $data;
    }

    private function getStatusCode(Throwable $error, ResponseInterface $response): int
    {
        $errorCode = $error->getCode();

        if (!is_numeric($errorCode)) {
            return 500;
        }

        if ($errorCode >= 400 && $errorCode < 600) {
            return (int)$errorCode;
        }

        $status = $response->getStatusCode();
        if (!$status || $status < 400 || $status >= 600) {
            $status = 500;
        }

        return $status;
    }
}
