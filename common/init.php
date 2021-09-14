<?php declare( strict_types=1 );

namespace Mertowitch\Phpneeds;

// >getConfig

require_once __DIR__ . "/../vendor/autoload.php";

// ********REDIS***************************
$objRedis = new \Redis();

$configRedis = include( __DIR__ . '/../confs/conf.redis.php' );

if ( str_contains( session_save_path(), 'auth=' ) )
{
	$objRedis->connect( $configRedis->HOST, $configRedis->PORT, 1, null, 0, 0, [ 'auth' => [ $configRedis->PASS ] ] );
} else
{
	$objRedis->connect( $configRedis->HOST, $configRedis->PORT, 1, null, 0, 0 );
}
// ********REDIS***************************

// ********SESSION*************************
use Mertowitch\Phpneeds\Session;

$objSession = new Session( $objRedis );
$objSession->init();
// ********SESSION*************************

// >initDatabase

//
