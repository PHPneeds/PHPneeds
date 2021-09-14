<?php declare( strict_types=1 );

namespace Mertowitch\Phpneeds;

require_once __DIR__ . "/../vendor/autoload.php";

// ********GLOBAL CONFIG*******************
$configGlobal = include( __DIR__ . '/../confs/conf.global.php' );
// ********GLOBAL CONFIG*******************

// ********REDIS***************************
$objRedis = new \Redis();

$configRedis = include( __DIR__ . '/../confs/conf.redis.php' );

$objRedis->connect( $configRedis->HOST, $configRedis->PORT, 1, null, 0, 0 );

if ( str_contains( session_save_path(), 'auth=' ) )
{
	$objRedis->auth( $configRedis->PASS );
}
// ********REDIS***************************

// ********SESSION*************************
$objSession = new Session( $objRedis );
$objSession->init();
// ********SESSION*************************

// >initDatabase

//
