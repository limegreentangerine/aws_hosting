<?php

declare(strict_types=1);

namespace {
    if (!defined('C5_EXECUTE')) {
        define('C5_EXECUTE', true);
    }

    if (!defined('DIR_PACKAGES_CORE')) {
        define('DIR_PACKAGES_CORE', __DIR__);
    }

    if (!defined('DIR_PACKAGES')) {
        define('DIR_PACKAGES', __DIR__);
    }

    if (!defined('REL_DIR_PACKAGES_CORE')) {
        define('REL_DIR_PACKAGES_CORE', 'packages');
    }

    if (!defined('REL_DIR_PACKAGES')) {
        define('REL_DIR_PACKAGES', 'packages');
    }

    if (!function_exists('t')) {
        function t(string $text, ...$args): string
        {
            return $args === [] ? $text : sprintf($text, ...$args);
        }
    }

    class_alias(\Concrete\Core\Support\Facade\Route::class, 'Route');
}

namespace Aws\Tests {

    use PHPUnit\Framework\TestCase;
    use Concrete\Package\Aws\Controller;
    use Concrete\Core\Support\Facade\Route;
    use Symfony\Component\HttpFoundation\Response;

    require_once dirname(__DIR__) . '/controller.php';

    final class ControllerTest extends TestCase
    {
        public function testPackageMetadata(): void
        {
            $controller = (new \ReflectionClass(Controller::class))
                ->newInstanceWithoutConstructor();

            self::assertSame('AWS', $controller->getPackageName());
            self::assertSame(
                'ConcreteCMS tools for AWS deployments',
                $controller->getPackageDescription(),
            );
        }

        public function testHealthRouteReturnsAcceptedResponse(): void
        {
            $router = new RecordingRouter();
            Route::setFacadeApplication(new TestContainer($router));

            $controller = (new \ReflectionClass(Controller::class))
                ->newInstanceWithoutConstructor();
            $controller->on_start();

            self::assertSame(['/aws/health'], $router->paths);
            self::assertCount(1, $router->actions);
            self::assertIsCallable($router->actions[0]);

            $response = ($router->actions[0])();

            self::assertInstanceOf(Response::class, $response);
            self::assertSame(Response::HTTP_OK, $response->getStatusCode());
            self::assertSame('OK', $response->getContent());
        }
        protected function tearDown(): void
        {
            Route::clearResolvedInstances();
        }
    }

    final class RecordingRouter
    {
        /**
         * @var list<string>
         */
        public array $paths = [];

        /**
         * @var list<callable>
         */
        public array $actions = [];

        public function register(string $path, callable $action): void
        {
            $this->paths[] = $path;
            $this->actions[] = $action;
        }
    }

    final class TestContainer implements \ArrayAccess
    {
        public function __construct(private readonly RecordingRouter $router) {}

        public function offsetExists(mixed $offset): bool
        {
            return $offset === 'Concrete\Core\Routing\Router';
        }

        public function offsetGet(mixed $offset): RecordingRouter
        {
            return $this->router;
        }

        public function offsetSet(mixed $offset, mixed $value): void {}

        public function offsetUnset(mixed $offset): void {}
    }
}
