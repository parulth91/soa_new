<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Acl' => $baseDir . '/vendor/cakephp/acl/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'Bootstrap' => $baseDir . '/vendor/elboletaire/twbs-cake-plugin/',
        'BootstrapUI' => $baseDir . '/vendor/friendsofcake/bootstrap-ui/',
        'CakeDC/Auth' => $baseDir . '/vendor/cakedc/auth/',
        'CakeDC/Users' => $baseDir . '/vendor/cakedc/users/',
        'CakeExcel' => $baseDir . '/vendor/dakota/cake-excel/',
        'CakePdf' => $baseDir . '/vendor/friendsofcake/cakepdf/',
        'Crud' => $baseDir . '/vendor/friendsofcake/crud/',
        'DatabaseLog' => $baseDir . '/vendor/dereuromark/cakephp-databaselog/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'FontAwesome' => $baseDir . '/vendor/drmonkeyninja/cakephp-font-awesome/',
        'Geo' => $baseDir . '/vendor/dereuromark/cakephp-geo/',
        'Less' => $baseDir . '/vendor/elboletaire/less-cake-plugin/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'WyriHaximus/TwigView' => $baseDir . '/vendor/wyrihaximus/twig-view/'
    ]
];