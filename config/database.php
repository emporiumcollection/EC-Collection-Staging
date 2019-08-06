<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */

    'fetch' => PDO::FETCH_CLASS,

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => storage_path('database.sqlite'),
            'prefix'   => '',
        ],

        'mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'ev_staging_new'),
            'username'  => env('DB_USERNAME', 'root'),
            'password'  => env('DB_PASSWORD', ''),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],
        'mysql1' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'desigr_db3'),
            'username'  => env('DB_USERNAME', 'root'),
            'password'  => env('DB_PASSWORD', 'n7Bh2XjQbAh7UxWM'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],
        'voyageconn' => [
            'driver'    => 'mysql',
            'host'      => '172.104.152.49',
            'database'  => 'emporium_voyage_staging',
            'username'  => 'voyage',
            'password'  => 'kjeDB/Jr',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],
        'islandconn' => [
            'driver'    => 'mysql',
            'host'      => '172.105.65.251',
            'database'  => 'emporium_islands_live',
            'username'  => 'islands',
            'password'  => '5rqLRezf',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],
        'stagingconn' => [
            'driver'    => 'mysql',
            'host'      => '172.104.152.49',
            'database'  => 'emporium_voyage_staging',
            'username'  => 'voyage',
            'password'  => 'kjeDB/Jr',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],
        'spaconn' => [
            'driver'    => 'mysql',
            'host'      => '172.105.65.213',
            'database'  => 'emporium_spa_live',
            'username'  => 'spa',
            'password'  => 'enAXhlT',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],
        'safariconn' => [
            'driver'    => 'mysql',
            'host'      => '139.162.150.108',
            'database'  => 'emporium_safari_live',
            'username'  => 'safari',
            'password'  => 'SjI5UUcJ',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],
        /*'voyageconn' => [
            'driver'    => 'mysql',
            'host'      => 'livetest.crlnfg2upqbc.eu-west-1.rds.amazonaws.com',
            'database'  => 'livetest',
            'username'  => 'livetest',
            'password'  => 'livetest',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],
        'islandconn' => [
            'driver'    => 'mysql',
            'host'      => 'emporiumislands.ci3okg85xopv.eu-west-2.rds.amazonaws.com',
            'database'  => 'emporium_islands',
            'username'  => 'root',
            'password'  => '$CH+5rqLRezf',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],
        'stagingconn' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'ev_staging',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],
        'spaconn' => [
            'driver'    => 'mysql',
            'host'      => 'livenew.crlnfg2upqbc.eu-west-1.rds.amazonaws.com',
            'database'  => 'emporium-voyage',
            'username'  => 'root',
            'password'  => '$CH+5rqLRezf',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],
        'safariconn' => [
            'driver'    => 'mysql',
            'host'      => 'emporium-safari.crlnfg2upqbc.eu-west-1.rds.amazonaws.com',
            'database'  => 'emporium_safari',
            'username'  => 'root',
            'password'  => '$CH+5rqLRezf',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'options'   => [ PDO::ATTR_EMULATE_PREPARES => true ],
        ],*/

        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
        ],

        'sqlsrv' => [
            'driver'   => 'sqlsrv',
            'host'     => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'prefix'   => '',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'cluster' => false,

        'default' => [
            'host'     => '127.0.0.1',
            'port'     => 6379,
            'database' => 0,
        ],

    ],

];
