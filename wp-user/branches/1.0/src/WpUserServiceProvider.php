<?php

declare(strict_types=1);

namespace Pollen\WpUser;

use Pollen\Container\BaseServiceProvider;

class WpUserServiceProvider extends BaseServiceProvider
{
    /**
     * @inheritDoc
     */
    protected $provides = [
        WpUserManagerInterface::class,
        WpUserRoleManagerInterface::class,
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(
            WpUserManagerInterface::class,
            function () {
                return new WpUserManager([], $this->getContainer());
            }
        );

        $this->getContainer()->share(
            WpUserRoleManagerInterface::class,
            function () {
                return new WpUserRoleManager($this->getContainer());
            }
        );
    }
}
