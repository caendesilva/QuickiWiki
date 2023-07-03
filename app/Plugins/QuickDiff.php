<?php

namespace App\Plugins;

/**
 * Simple diffing for strings.
 *
 * @experimental
 */
class QuickDiff
{
    public static function calculate(string $new, ?string $old): string
    {
        if ($old === null) {
            return 'Article created.';
        }

        if ($old === $new) {
            return 'No changes made.';
        }

        [$oldBytes, $newBytes] = [strlen($old), strlen($new)];

        return sprintf("%s %s bytes.", match (true) {
            $oldBytes > $newBytes => 'Added',
            $newBytes > $oldBytes => 'Removed',
            default => 'Changed',
        }, abs($oldBytes - $newBytes));
    }
}
