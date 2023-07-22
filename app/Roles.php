<?php

namespace App;

/**
 * The roles for the application. These are used to determine what a user can and cannot do.
 *
 * Each role inherits the permissions of the roles below it. So an editor can do everything a user can do,
 * and an admin can do everything an editor can do, including that of a user and guest.
 */
enum Roles: string
{
    /**
     * The administrator role. Has full access to the application.
     */
    case Admin = 'admin';

    /**
     * The editor role, for trusted users.
     *
     * Articles can be restricted to only be edited by editors or above.
     */
    case Editor = 'editor';

    /**
     * The default user role. Can create and edit articles.
     */
    case User = 'user';

    /**
     * The guest role which only has read permissions.
     *
     * Admins can demote users to this role to prevent them from editing articles.
     */
    case Guest = 'guest';
}
