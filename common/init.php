<?php declare( strict_types=1 );

require_once __DIR__ . "/../vendor/autoload.php";

use Phpneeds\Libs\
{
    Database,
    Redis,
    Session,
    User,
    Image
};

// *****************************************
// ********GLOBAL CONFIG********************
$configGlobal = include( __DIR__ . '/../confs/conf.global.php' );
// ********GLOBAL CONFIG********************

// *****************************************
// ********REDIS****************************
$objRedis = Redis::getInstance();
// ********REDIS****************************

// *****************************************
// ********SESSION**************************
if ( $objRedis )
{
    $objSession = new Session( $objRedis );
    $objSession->init();
}
// ********SESSION**************************

// *****************************************
// ********DATABASE*************************
$objDatabase = Database::getInstance();
// ********DATABASE*************************

// *****************************************
// ********USER*****************************
if ( $objDatabase )
{
    $objUser = new User( $objDatabase ) ?: null;
}
// ********USER*****************************

// ********IMAGE****************************
$objImage = new Image();
// ********IMAGE****************************
