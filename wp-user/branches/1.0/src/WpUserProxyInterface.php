<?php

declare(strict_types=1);

namespace Pollen\WpUser;

use WP_User;
use WP_User_Query;

interface WpUserProxyInterface
{
    /**
     * Instance du gestionnaire d'utilisateurs Wordpress.
     *
     * @param true|string|int|WP_User|WP_User_Query|array|null $query
     *
     * @return WpUserManagerInterface|WpUserQueryInterface|WpUserQueryInterface[]|array
     */
    public function wpUser($query = null);

    /**
     * Définition du gestionnaire d'utilisateurs Wordpress.
     *
     * @param WpUserManagerInterface $wpUserManager
     *
     * @return void
     */
    public function setWpUserManager(WpUserManagerInterface $wpUserManager): void;
}
