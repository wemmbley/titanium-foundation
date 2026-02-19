<?php

namespace TitaniumFoundation\Core\Helpers;

class Arr
{
    /**
     * Check, if array has key
     *
     * @param array $array
     * @param string $key
     * @return bool
     */
    public static function has(array $array, string $key): bool
    {
        foreach ($array as $value)
            if ($value === $key) return true;
        return false;
    }

    /**
     * Check, if array has required keys.
     *
     * <code>
     *      Arr::hasKeys(['one'], ['hey', 'wow', 'nope']); // false
     *      Arr::hasKeys(['one'], ['hey', 'one', 'nope']); // true
     * </code>
     *
     * @param array $needleKeys
     * @param array $haystackArray
     * @return bool
     */
    public static function hasKeys(array $needleKeys, array $haystackArray): bool
    {
        return count(array_intersect_key($needleKeys, array_keys($haystackArray))) === count($needleKeys);
    }

    /**
     * Reindex array.
     *
     * <code>
     *      // from
     *      [2 => 'hi', 9 => 'Rustam']
     *
     *      // to
     *      [0 => 'hi', 1 => 'Rustam']
     * </code>
     *
     * @param array $array
     * @return array
     */
    public static function reindex(array $array): array
    {
        return array_values($array);
    }

    /**
     * Get random array element.
     *
     * @param array $array
     * @param int $count
     * @return string|array|int
     */
    public static function random(array $array, int $count = 1): string|array|int
    {
        $randomIndex = array_rand($array, $count);

        return $array[$randomIndex];
    }
}