<?php

declare(strict_types=1);

namespace Pollen\WpUser;

use Pollen\Support\Concerns\BootableTraitInterface;
use Pollen\Support\Concerns\ConfigBagAwareTraitInterface;
use Pollen\Support\Proxy\ContainerProxyInterface;
use WP_User;
use WP_User_Query;

interface WpUserManagerInterface extends BootableTraitInterface, ConfigBagAwareTraitInterface, ContainerProxyInterface
{
    /**
     * Chargement.
     *
     * @return static
     */
    public function boot(): WpUserManagerInterface;

    /**
     * Liste des instances de utilisateurs courants ou associés à une requête WP_User_Query ou associés à une liste d'arguments.
     *
     * @param WP_User_Query|array|null $query
     *
     * @return WpUserQueryInterface[]|array
     */
    public function fetch($query = null): array;

    /**
     * Instance de l'utilisateur courant ou associé à une définition.
     *
     * @param string|int|WP_User|null $user
     *
     * @return WpUserQueryInterface|null
     */
    public function get($user = null): ?WpUserQueryInterface;

    /**
     * Récupération de l'instance d'un rôle.
     *
     * @param string $name
     *
     * @return WpUserRoleInterface|null
     */
    public function getRole(string $name): ?WpUserRoleInterface;

    /**
     * Déclaration d'un rôle.
     *
     * @param string $name
     * @param WpUserRoleInterface|array $roleDef
     *
     * @return WpUserRoleInterface
     */
    public function registerRole(string $name, $roleDef = []): WpUserRoleInterface;

    /**
     * Instance du gestionnaire de rôles Wordpress.
     *
     * @return WpUserRoleManagerInterface
     */
    public function roleManager(): WpUserRoleManagerInterface;
}