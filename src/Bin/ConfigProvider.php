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
            'commands' => $this->getCommands(),
            'dependencies' => $this->getDependencies(),
        ];
    }

    private function getCommands(): array
    {
        return [
            Command\ExampleCommand::class,
        ];
    }

    private function getDependencies(): array
    {
        return [
            'aliases' => [
            ],
            'invokables' => [
                Command\ExampleCommand::class,
            ],
            'factories' => [
            ],
        ];
    }
}
