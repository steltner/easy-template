<?php declare(strict_types=1);

use Easy\InvocableResolver;
use Mezzio\Application as MezzioApplication;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ApplicationConfigTest extends TestCase
{
    public function testConfigProvider(): void
    {
        $application = $this->getApplicationMock();

        $providers = (new InvocableResolver)->resolveList(
            [
                new Application\ConfigProvider(),

                Application\ConfigProvider::class,
                Bin\ConfigProvider::class,
            ]
        );

        foreach ($providers as $provider) {
            $this->assertTrue(is_callable($provider));

            $config = $provider();

            $this->assertTrue(is_array($config));

            if (is_callable([$provider, 'registerRoutes'])) {
                $provider->registerRoutes($application);
            }
        }
    }

    public function testInvalidProvider(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new InvocableResolver)->resolveList(['abc']);
    }

    /**
     * @return MezzioApplication|MockObject
     */
    public function getApplicationMock(): MezzioApplication
    {
        return $this->getMockBuilder(MezzioApplication::class)->disableOriginalConstructor()->getMock();
    }
}
