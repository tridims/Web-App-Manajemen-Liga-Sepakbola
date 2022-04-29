<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit36643ced6baac97a448d40974b455ad8
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

        spl_autoload_register(array('ComposerAutoloaderInit36643ced6baac97a448d40974b455ad8', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit36643ced6baac97a448d40974b455ad8', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInit36643ced6baac97a448d40974b455ad8::getInitializer($loader)();

        $loader->register(true);

        return $loader;
    }
}
