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
     * Instance de l'utilisateur courant ou associé à une définition.
     *
     * @param string|int|WP_User|null $user
     *
     * @return WpUserQueryInterface|null
     */
    public function user($user = null): ?WpUserQueryInterface;

    /**
     * Liste des instances de utilisateurs courants ou associés à une requête WP_User_Query ou associés à une liste d'arguments.
     *
     * @param WP_User_Query|array|null $query
     *
     * @return WpUserQueryInterface[]|array
     */
    public function users($query = null): array;
}