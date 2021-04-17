<?php

declare(strict_types=1);

namespace Pollen\WpUser;

use Pollen\Support\Concerns\BootableTrait;
use Pollen\Support\Concerns\ConfigBagAwareTrait;
use Pollen\Support\Exception\ManagerRuntimeException;
use Pollen\Support\Proxy\ContainerProxy;
use Psr\Container\ContainerInterface as Container;

class WpUserManager implements WpUserManagerInterface
{
    use BootableTrait;
    use ConfigBagAwareTrait;
    use ContainerProxy;

    /**
     * Instance principale.
     * @var static|null
     */
    private static $instance;

    /**
     * @param array $config
     * @param Container|null $container Instance du conteneur d'injection de dépendances.
     *
     * @return void
     */
    public function __construct(array $config = [], ?Container $container = null)
    {
        $this->setConfig($config);

        if ($container !== null) {
            $this->setContainer($container);
        }

        if ($this->config('boot_enabled', true)) {
            $this->boot();
        }

        if (!self::$instance instanceof static) {
            self::$instance = $this;
        }
    }

    /**
     * Récupération de l'instance principale.
     *
     * @return static
     */
    public static function getInstance(): WpUserManagerInterface
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }
        throw new ManagerRuntimeException(sprintf('Unavailable [%s] instance', __CLASS__));
    }

    /**
     * @inheritDoc
     */
    public function boot(): WpUserManagerInterface
    {
        if (!$this->isBooted()) {
            add_action(
                'init',
                function () {
                    global $wp_roles;

                    /** @var WpUserRoleManagerInterface $roleManager */
                    $roleManager = $this->containerHas(WpUserRoleManagerInterface::class)
                        ? $this->containerGet(WpUserRoleManagerInterface::class) : new WpUserRoleManager();

                    foreach ($wp_roles->roles as $role => $data) {
                        if (!$roleManager->get($role)) {
                            $roleManager->register(
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

            $this->setBooted();
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function user($user = null): ?WpUserQueryInterface
    {
        return WpUserQuery::create($user);
    }

    /**
     * @inheritDoc
     */
    public function users($query = null): array
    {
        return WpUserQuery::fetch($query);
    }
}