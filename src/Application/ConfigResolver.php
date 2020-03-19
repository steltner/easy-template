<?php declare(strict_types=1);

namespace Application;

use Laminas\ConfigAggregator\InvalidConfigProviderException;

use function array_map;
use function is_callable;

class ConfigResolver
{
    public function resolveProviders(array $providers): array
    {
        return array_map([$this, 'resolveProvider'], $providers);
    }

    /**
     * @param string|callable $provider
     * @return callable
     * @throws InvalidConfigProviderException
     */
    private function resolveProvider($provider): callable
    {
        if (is_callable($provider)) {
            return $provider;
        } elseif (class_exists($provider)) {
            return new $provider();
        } else {
            throw InvalidConfigProviderException::fromNamedProvider($provider);
        }
    }
}
