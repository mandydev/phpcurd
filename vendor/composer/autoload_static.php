<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitca9016efbbd7be7d4d8080e399e00ff5
{
    public static $classMap = array (
        'Phpcurd\\CURD' => __DIR__ . '/..' . '/phpcurd/Curd.php',
        'Phpcurd\\Connection' => __DIR__ . '/..' . '/phpcurd/connection.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitca9016efbbd7be7d4d8080e399e00ff5::$classMap;

        }, null, ClassLoader::class);
    }
}