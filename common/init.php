<?php declare( strict_types=1 );

require_once __DIR__ . "/../vendor/autoload.php";

use Phpneeds\Libs\Database;
use Phpneeds\Libs\Redis;
use Phpneeds\Libs\Session;
use Phpneeds\Libs\User;

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
