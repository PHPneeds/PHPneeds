<?php declare( strict_types=1 );

/*
 * This file is part of PHPneeds.
 *
 * (c) Mertcan Ayhan <mertowitch@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mertowitch\Phpneeds
{

	use PDO;
	use PDOException;

	class Database
	{
		private static ?PDO $instance = null;
		private static object $config;
		private static string $configName;

		public function __construct( string $configName = 'default' )
		{
			self::$configName = $configName;
			self::_getConfig();
		}

		private static function _getConfig(): void
		{
			self::$config = include( __DIR__ . '/../confs/conf.db.' . self::$configName . '.php' );
		}

		public static function getInstance( string $configName = 'default' ): PDO
		{
			if ( self::$instance === null )
			{
				self::$instance = ( new self( $configName ) )->_getNewInstance();
			}

			return self::$instance;
		}

		private function _getNewInstance(): PDO
		{
			try
			{
				$options = array(
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION
				);

				$newDbInstance = new PDO( self::$config->TYPE . ':host=' . self::$config->HOST . ';port=' . self::$config->PORT . ';dbname=' . self::$config->NAME . ';charset=utf8', self::$config->USER, self::$config->PASS, $options );
			}
			catch ( PDOException $e )
			{
				exit( $e->getMessage() );
			}

			return $newDbInstance;
		}

		public static function getNewInstance( string $configName = 'default' ): PDO
		{
			return ( new self( $configName ) )->_getNewInstance();
		}
	}
}
