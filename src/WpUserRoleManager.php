<?php

declare(strict_types=1);

namespace Pollen\WpUser;

use Pollen\Support\Proxy\ContainerProxy;
use Psr\Container\ContainerInterface as Container;

class WpUserRoleManager implements WpUserRoleManagerInterface
{
    use ContainerProxy;

    /**
     * Liste des roles déclarés.
     * @var WpUserRoleFactoryInterface[]|array
     */
    public $roles = [];

    /**
     * @param Container|null $container
     */
    public function __construct(?Container $container = null)
    {
        if ($container !== null) {
            $this->setContainer($container);
        }
    }

    /**
     * @inheritDoc
     */
    public function get(string $name): ?WpUserRoleFactoryInterface
    {
        return $this->roles[$name] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function register(string $name, $args): WpUserRoleManagerInterface
    {
        if (!$args instanceof WpUserRoleFactoryInterface) {
            $role = new WpUserRoleFactory($name, is_array($args) ? $args : []);
        } else {
            $role = $args;
        }
        $this->roles[$name] = $role;

        return $this;
    }
}