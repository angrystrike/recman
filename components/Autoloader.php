<?php

namespace components;

/**
 * Custom autoloader
 * I decided to write it simpler without using composer because I don't use any PHP dependencies
 */
class Autoloader
{
    // Only allow autoload from known sources
    private static array $prefixes = [
        'components\\' => ROOT . '/components/',
        'models\\' => ROOT . '/models/',
        'controllers\\' => ROOT . '/controllers/',
        'core\\' => ROOT . '/core/',
    ];
    public static function register(): void
    {
        spl_autoload_register([self::class, 'autoload']);
    }

    private static function autoload(string $className): void
    {
        foreach (self::$prefixes as $prefix => $baseDir) {
            if (str_starts_with($className, $prefix)) {
                $relativeClass = substr($className, strlen($prefix));
                $path = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

                if (is_file($path)) {
                    require_once $path;
                }
                return;
            }
        }
    }
}
