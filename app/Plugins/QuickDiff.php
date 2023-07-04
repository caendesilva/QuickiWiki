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

        return sprintf("%s %s bytes.", match (self::calculateDelta($oldBytes, $newBytes)) {
            -1 => 'Removed',
            1 => 'Added',
            default => 'Changed',
        }, abs($oldBytes - $newBytes));
    }

    public static function calculateDelta(int $oldBytes, int $newBytes): int
    {
        return match (true) {
            $oldBytes > $newBytes => -1,
            $newBytes > $oldBytes => 1,
            default => 0,
        };
    }
}
