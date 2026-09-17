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
     * An array describing the package dependencies.
     * Keys are package handles.
     * Values may be:
     * - false: this package can't be installed if the other package is already installed.
     * - true: this package can't be installed of the other package is not installed
     * - a string: this package can't be installed of the other package is not installed or it's installed with an older version
     * - an array with two strings, representing the minimum and the maximum version of the other package to be installed.
     *
     * @var array
     *
     * @example [
     *     // This package can't be installed if a package with handle other_package_1 is already installed.
     *     'other_package_1' => false,
     *     // This package can't be installed if a package with handle other_package_2 is not installed.
     *     'other_package_2' => true,
     *     // This package can't be installed if a package with handle other_package_3 is not installed, or it has a version prior to 1.0
     *     'other_package_3' => '1.0',
     *     // This package can't be installed if a package with handle other_package_4 is not installed, or it has a version prior to 2.0, or it has a version after 2.9
     *     'other_package_4' => ['2.0', '2.9'],
     * ]
     */
    protected $packageDependencies = [
        'class_kit' => true
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
