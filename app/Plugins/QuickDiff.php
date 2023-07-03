<?php

namespace App\Plugins;

/**
 * Simple diffing for strings.
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

        $oldBytes = mb_strlen($old);
        $newBytes = mb_strlen($new);

        if ($oldBytes > $newBytes) {
            return 'Added ' . static::calculateDiff($old, $new) . ' bytes.';
        } else if ($newBytes > $oldBytes) {
            return 'Removed ' . static::calculateDiff($old, $new) . ' bytes.';
        } else {
            return 'Changed ' . static::calculateDiff($old, $new) . ' bytes.';
        }
    }

    private static function calculateDiff(string $old, string $new):int
    {
        $oldBytes = mb_strlen($old);
        $newBytes = mb_strlen($new);

        if ($oldBytes > $newBytes) {
            return $oldBytes - $newBytes;
        }

        return $newBytes - $oldBytes;
    }
}
