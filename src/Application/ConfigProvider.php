<?php declare(strict_types=1);

namespace Application;

use Laminas\ServiceManager\AbstractFactory\ConfigAbstractFactory;
use Mezzio\Application;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            ConfigAbstractFactory::class => $this->getAbstractFactoryConfig(),
        ];
    }

    private function getDependencies(): array
    {
        return [
            'aliases' => [
            ],
            'invokables' => [
                Handler\PingHandler::class,
                Handler\NotFoundHandler::class,
            ],
            'factories' => [
                Handler\IndexHandler::class => Handler\IndexHandlerFactory::class,
            ],
        ];
    }

    private function getAbstractFactoryConfig(): array
    {
        return [
        ];
    }

    public function registerRoutes(Application $app): void
    {
        $app->get('/', Handler\IndexHandler::class, Handler\IndexHandler::class);
        $app->get('/ping', Handler\PingHandler::class, Handler\PingHandler::class);
    }
}
