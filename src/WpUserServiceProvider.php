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
        WpUserRoleManagerInterface::class,
    ];

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        add_action(
            'init',
            function () {
                global $wp_roles;

                /** @var WpUserRoleManagerInterface $manager */
                $manager = $this->getContainer()->get(WpUserRoleManagerInterface::class);

                foreach ($wp_roles->roles as $role => $data) {
                    if (!$manager->get($role)) {
                        $manager->register(
                            $role,
                            [
                                'display_name' => translate_user_role($data['name']),
                                'capabilities' => array_keys($data['capabilities']),
                            ]
                        );
                    }
                }
            },
            999998
        );
    }

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(
            WpUserRoleManagerInterface::class,
            function () {
                return new WpUserRoleManager($this->getContainer());
            }
        );
    }
}
