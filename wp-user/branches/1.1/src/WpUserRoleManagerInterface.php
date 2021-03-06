<?php

declare(strict_types=1);

namespace Pollen\WpUser;

use Pollen\Support\Proxy\ContainerProxyInterface;

interface WpUserRoleManagerInterface extends ContainerProxyInterface
{
    /**
     * Récupération d'une instance de rôle déclaré.
     *
     * @param string $name.
     *
     * @return WpUserRoleFactoryInterface
     */
    public function get(string $name): ?WpUserRoleFactoryInterface;

    /**
     * Déclaration d'un rôle.
     *
     * @param string $name
     * @param WpUserRoleFactoryInterface|array $args
     *
     * @return static
     */
    public function register(string $name, $args): WpUserRoleManagerInterface;
}