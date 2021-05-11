<?php

declare(strict_types=1);

namespace Pollen\WpUser;

use Pollen\Support\Proxy\ContainerProxyInterface;

interface WpUserRoleManagerInterface extends ContainerProxyInterface
{
    /**
     * Récupération de la liste des instance de rôles déclarés.
     *
     * @return WpUserRoleInterface[]|array
     */
    public function all(): array;

    /**
     * Récupération d'une instance de rôle déclaré.
     *
     * @param string $name.
     *
     * @return WpUserRoleInterface|null
     */
    public function get(string $name): ?WpUserRoleInterface;

    /**
     * Déclaration d'un rôle.
     *
     * @param string $name
     * @param WpUserRoleInterface|array $roleDef
     *
     * @return WpUserRoleInterface
     */
    public function register(string $name, $roleDef): WpUserRoleInterface;
}