<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitdfeb8380f26fb12e70fee231546c4a4f
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

        spl_autoload_register(array('ComposerAutoloaderInitdfeb8380f26fb12e70fee231546c4a4f', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitdfeb8380f26fb12e70fee231546c4a4f', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitdfeb8380f26fb12e70fee231546c4a4f::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
