<?php declare( strict_types=1 );

namespace Mertowitch\Phpneeds;

require_once __DIR__ . "/../vendor/autoload.php";

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
$objDatabase = Database::getInstance();
// ********DATABASE*************************

// ********USER*****************************
$objUser = new User( $objDatabase );
// ********DATABASE*************************
