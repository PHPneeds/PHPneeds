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

    /**
     * Class User
     */
    class User
    {

        private Database $objDatabase;

        public function __construct( Database $objDatabase )
        {
            $this->objDatabase = $objDatabase;
        }

        public function getByID( int $userID ): array|bool
        {
            if ( $return = $this->_getByID( $userID ) )
            {
                return $return;
            }

            return false;
        }

        private function _getByID( int $userID ): array|bool
        {
            $qryUser = $this->objDatabase->prepare( 'SELECT * FROM `users` WHERE `ID`=:ID LIMIT 1' );
            $qryUser->bindParam( ':ID', $userID, PDO::PARAM_INT );
            $qryUser->execute();

            return $qryUser->fetch();
        }

        public function getAll(): array|bool
        {
            if ( $return = $this->_getAll() )
            {
                return $return;
            }

            return false;
        }

        private function _getAll(): array|bool
        {
            $qryUser = $this->objDatabase->query( 'SELECT * FROM `users`' );

            return $qryUser->fetchAll();
        }

        public function getByUsername( string $username ): array|bool
        {
            if ( $return = $this->_getByUsername( $username ) )
            {
                return $return;
            }

            return false;
        }

        private function _getByUsername( string $username ): array|bool
        {
            $qryUser = $this->objDatabase->prepare( 'SELECT * FROM `users` WHERE `username`=:username LIMIT 1' );
            $qryUser->bindParam( ':username', $username, PDO::PARAM_STR );
            $qryUser->execute();

            return $qryUser->fetch();
        }

        public function login( string $username, string $password ): bool
        {
            if ( ! $this->_verifyCredential( $username, $password ) )
            {
                return false;
            }

            return true;
        }

        private function _verifyCredential( string $username, string $password ): bool
        {
            return ( $arrUser = $this->_getByUsername( $username ) ) && $arrUser['password'] === md5( $password );
        }

    }
}
