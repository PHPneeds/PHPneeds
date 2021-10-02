<?php declare( strict_types=1 );

require_once __DIR__ . "/../vendor/autoload.php";

use Phpneeds\Libs\
{
    Database,
    Redis,
    Session,
    User
};

// ********GLOBAL CONFIG*******************
$configGlobal = include( __DIR__ . '/../confs/conf.global.php' );
// ********GLOBAL CONFIG*******************

// ********REDIS***************************
$objRedis = Redis::getInstance();
// ********REDIS***************************

// ********SESSION*************************
$objSession = new Session( $objRedis );
$objSession->init();
// ********SESSION*************************

// ********DATABASE*************************
try
{
    $objDatabase = Database::getInstance();
}
catch ( PDOException $e )
{
    $objDatabase = null;
    echo 'ERROR: Database connection failed!';
}
// ********DATABASE*************************

// ********USER*****************************
if ( $objDatabase )
{
    $objUser = new User( $objDatabase );
}
// ********DATABASE*************************
