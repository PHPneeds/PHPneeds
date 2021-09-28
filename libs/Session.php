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

    use JsonException;

    /**
     * Class Session
     *
     * @package Mertowitch\Phpneeds
     */
    class Session
    {
        private static object $config;
        private static Redis $objRedis;

        /**
         * Session constructor.
         *
         * @param Redis $objRedis
         */
        public function __construct( Redis $objRedis )
        {
            self::_getConfig();
            self::$objRedis = $objRedis;
        }

        private static function _getConfig(): void
        {
            self::$config = include( __DIR__ . '/../confs/conf.session.php' );
        }

        /**
         * Destroy the session self like 'session_destroy()'
         *
         * @return bool
         */
        public static function selfDestroy(): bool
        {
            return session_destroy();
        }

        /**
         * Initialize the session
         *
         * @return bool
         */
        public function init(): bool
        {
            switch ( self::$config->MODE )
            {
                case 'files':
                    ini_set( 'session.save_handler', 'files' );
                    ini_set( 'session.name', self::$config->NAME );
                    ini_set( 'session.save_path', self::$config->PATH );
                    ini_set( "session.cookie_httponly", '1' );
                    ini_set( 'session.cookie_secure', '1' );

                    ini_set( 'session.gc_maxlifetime', '1800' );
                    ini_set( 'session.gc_probability', '50' );
                    ini_set( 'session.gc_divisor', '100' );

                    break;

                case 'redis':
                    $prefixGlue = ( str_contains( session_save_path(), '?' ) ) ? '&' : '?';

                    $sessionSavePath = session_save_path() . $prefixGlue . 'prefix=' . self::$config->NAME . ':';

                    ini_set( 'session.save_handler', 'redis' );
                    ini_set( 'session.save_path', $sessionSavePath );
                    ini_set( 'session.name', self::$config->NAME );
                    ini_set( "session.cookie_httponly", '1' );
                    ini_set( 'session.cookie_secure', '1' );

                    break;
            }

            return session_start();
        }

        /**
         * Destroy another session with sessionID
         *
         * @param string $sessionID
         *
         * @return bool
         */
        public function destroy( string $sessionID ): bool
        {
            return match ( self::$config->MODE )
            {
                'files' => unlink( self::$config->PATH . 'sess_' . $sessionID ),
                'redis' => (bool) self::$objRedis->del( self::$config->NAME . ':' . $sessionID ),
                default => false,
            };
        }

        /**
         * @throws JsonException
         */
        public function getByUserName( string $userName ): array
        {
            $ArrSession = array();

            foreach ( $this->getList() as $session )
            {
                $strlen  = strlen( $userName );
                $pattern = "UserName|s:$strlen:\"$userName\"";

                if ( str_contains( $session['data'], $pattern ) )
                {
//					var_dump($session);
                    $ArrSession[] = $session;
                }
            }

//			$ArrSession[0]=$pattern;
            return $ArrSession;
        }

        /**
         * @throws JsonException
         */
        public function getList( string $outputFormat = 'array' ): array
        {
            $result = array();

            switch ( self::$config->MODE )
            {
                case 'files':

                    foreach ( glob( self::$config->PATH . "sess_*" ) as $filename )
                    {
                        $result[] = array(
                            'id'   => explode( '_', basename( $filename ) )[1],
                            'name' => basename( $filename ),
                            'size' => filesize( $filename ),
                            'data' => file_get_contents( $filename )
                        );
                    }

                    break;

                case 'redis':

                    $arrSessionNames = self::$objRedis->keys( self::$config->NAME . '*' ) ?: [];

                    foreach ( $arrSessionNames as $sessionName )
                    {
                        $session = self::$objRedis->get( $sessionName );

                        $result[] = array(
                            'id'   => explode( ':', $sessionName )[1],
                            'name' => basename( $sessionName ),
                            'data' => $session
                        );
                    }

                    break;
            }

            try
            {
                return match ( $outputFormat )
                {
                    'array' => $result,
                    'json' => json_encode( $result, JSON_THROW_ON_ERROR | JSON_FORCE_OBJECT ),
                };
            }
            catch ( JsonException $e )
            {
                throw new JsonException ( $e->getMessage() );
            }
        }

    }
}
