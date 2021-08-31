<?php

declare( strict_types=1 );

namespace mertowitch\PHPneeds
{

	use PDO;
	use PDOException;

	class database
	{
		private static ?PDO $instance = null;
		private object $config;
		private string $configName;

		public function __construct( string $configName = 'default' )
		{
			$this->configName = $configName;
			$this->_getConfig();
		}

		private function _getConfig(): void
		{
			( $this->config = include( __DIR__ . '/../Confs/conf.db.' . $this->configName . '.php' ) );
		}

		public static function getInstance( string $configName = 'default' ): PDO
		{
			if ( self::$instance === null )
			{
				self::$instance = ( new database( $configName ) )->_getNewInstance();
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

				$newDbInstance = new PDO( $this->config->DATABASE_TYPE . ':host=' . $this->config->DATABASE_HOST . ';port=' . $this->config->DATABASE_PORT . ';dbname=' . $this->config->DATABASE_NAME . ';charset=utf8', $this->config->DATABASE_USER, $this->config->DATABASE_PASS, $options );
			}
			catch ( PDOException $e )
			{
				exit( $e->getMessage() );
			}

			return $newDbInstance;
		}

		public static function getNewInstance( string $configName = 'default' ): PDO
		{
			return ( new database( $configName ) )->_getNewInstance();
		}
	}
}
