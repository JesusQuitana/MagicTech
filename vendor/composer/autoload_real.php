<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit50e3a2b8b276f0468cd46b3c51c22614
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit50e3a2b8b276f0468cd46b3c51c22614', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit50e3a2b8b276f0468cd46b3c51c22614', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit50e3a2b8b276f0468cd46b3c51c22614::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
