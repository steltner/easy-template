<?php declare(strict_types=1);

namespace Bin;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'commands' => [
                Command\ExampleCommand::class,
            ]
        ];
    }
}
