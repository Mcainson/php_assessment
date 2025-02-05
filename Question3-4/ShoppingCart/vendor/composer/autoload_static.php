<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc3894f299ed53fd29c10473d091ae347
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'ShoppingCart\\' => 13,
        ),
        'B' => 
        array (
            'Brick\\Math\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ShoppingCart\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Brick\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/brick/math/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc3894f299ed53fd29c10473d091ae347::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc3894f299ed53fd29c10473d091ae347::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc3894f299ed53fd29c10473d091ae347::$classMap;

        }, null, ClassLoader::class);
    }
}
