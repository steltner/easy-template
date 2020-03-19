<?php declare(strict_types=1);

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

(function () {
    require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'const.php';

    $config = require CONFIG . 'config.php';

    $aggregatedConfig = (new Laminas\ConfigAggregator\ConfigAggregator($config))->getMergedConfig();

    $dependencies = $aggregatedConfig['dependencies'];
    $dependencies['services']['config'] = $aggregatedConfig;

    $container = new Laminas\ServiceManager\ServiceManager($dependencies);

    /** @var \Mezzio\Application $application */
    $application = $container->get(Mezzio\Application::class);

    (require CONFIG . 'pipeline.php')($application);
    (require CONFIG . 'routes.php')($application, $config);

    $application->run();
})();
