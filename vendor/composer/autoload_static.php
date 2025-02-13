<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit434f564596598b944be63ce52944f2ca
{
    public static $prefixLengthsPsr4 = array (
        'Y' => 
        array (
            'Ymzf\\Pay\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ymzf\\Pay\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit434f564596598b944be63ce52944f2ca::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit434f564596598b944be63ce52944f2ca::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit434f564596598b944be63ce52944f2ca::$classMap;

        }, null, ClassLoader::class);
    }
}
