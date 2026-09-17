<?php

namespace Concrete\Package\AwsHosting;

use Route;
use Concrete\Core\Entity\Package;
use ClassKit\Package\PackageController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends PackageController
{
    /**
     * The packages handle.
     * Note that this must be unique in the
     * entire concrete5 package ecosystem.
     *
     * @var string
     */
    protected $pkgHandle = 'aws_hosting';

    /**
     * The packages version.
     *
     * @var string
     */
    protected $pkgVersion = '1.0.0';

    /**
     * The minimum Concrete version compatible with the package.
     * Override this value according to the minimum required version for your package.
     *
     * @var string
     */
    protected $appVersionRequired = '9.5.0';

    /**
     * The minimum PHP version compatible with the package.
     * Override this value according to the minimum required version for your package.
     *
     * @var string
     * @var string
     */
    protected $phpVersionRequired = '8.4';

    /**
     * Package class autoloader registrations
     * The package install helper class, included with this boilerplate,
     * is activated by default.
     *
     * @see https://goo.gl/4wyRtH
     * @var array
     */
    protected $pkgAutoloaderRegistries = [
        'src' => '\AwsHosting',
    ];

    /**
     * Register URL Routes
     */
    public function registerRoutes(): void
    {
        Route::register('/aws/health', function () {
            return new Response('OK', Response::HTTP_OK);
        });
    }

    public function getPackageName()
    {
        return t('AWS Hosting');
    }

    public function getPackageDescription()
    {
        return t('ConcreteCMS tools for AWS hosted deployments');
    }

    public function registerEvents(): void {}

    public function installOrUpgrade(Package $pkg): void {}

    public function on_start()
    {
        $this->registerRoutes();
    }
}
