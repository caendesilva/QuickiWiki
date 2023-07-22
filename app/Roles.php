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
     * Articles can be restricted by editors to only allow editing by editors or above.
     */
    case Editor = 'editor';

    /**
     * The default user role. Can create and edit all articles except those restricted to editors.
     */
    case User = 'user';

    /**
     * The guest role which only has read permissions.
     *
     * Admins can demote users to this role to prevent them from editing any articles or creating new ones.
     */
    case Guest = 'guest';

    public static function all(): array
    {
        return [
            self::Admin,
            self::Editor,
            self::User,
            self::Guest,
        ];
    }

    public function permissionLevel(): int
    {
        return match ($this) {
            self::Admin => 3,
            self::Editor => 2,
            self::User => 1,
            self::Guest => 0,
        };
    }
}
