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

    /**
     * Class User
     */
    class User
    {

        private Database $objDatabase;

        /**
         * @param Database $objDatabase
         */
        public function __construct( Database $objDatabase )
        {
            $this->objDatabase = $objDatabase;
        }

        /**
         * @param int $lenght
         *
         * @return string
         */
        public static function getNewRandomPassword( int $lenght ): string
        {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $shfl  = str_shuffle( $chars );

            return substr( $shfl, 9, $lenght );
        }

        /**
         * @param int $userID
         *
         * @return array|bool
         */
        public function getByID( int $userID ): array|bool
        {
            if ( $return = $this->_getByID( $userID ) )
            {
                return $return;
            }

            return false;
        }

        /**
         * @param int $userID
         *
         * @return array|bool
         */
        private function _getByID( int $userID ): array|bool
        {
            $qryUser = $this->objDatabase->prepare( 'SELECT * FROM `users` WHERE `ID`=:ID LIMIT 1' );
            $qryUser->bindParam( ':ID', $userID, PDO::PARAM_INT );
            $qryUser->execute();

            return $qryUser->fetch();
        }

        /**
         * @return array|bool
         */
        public function getAll(): array|bool
        {
            if ( $return = $this->_getAll() )
            {
                return $return;
            }

            return false;
        }

        /**
         * @return array|bool
         */
        private function _getAll(): array|bool
        {
            $qryUser = $this->objDatabase->query( 'SELECT * FROM `users`' );

            return $qryUser->fetchAll();
        }

        /**
         * @param string $username
         *
         * @return array|bool
         */
        public function getByUsername( string $username ): array|bool
        {
            if ( $return = $this->_getByUsername( $username ) )
            {
                return $return;
            }

            return false;
        }

        /**
         * @param string $username
         *
         * @return array|bool
         */
        private function _getByUsername( string $username ): array|bool
        {
            $qryUser = $this->objDatabase->prepare( 'SELECT * FROM `users` WHERE `username`=:username LIMIT 1' );
            $qryUser->bindParam( ':username', $username, PDO::PARAM_STR );
            $qryUser->execute();

            return $qryUser->fetch();
        }

        /**
         * @param string $username
         * @param string $password
         *
         * @return bool
         */
        public function login( string $username, string $password ): bool
        {
            if ( ! $this->_verifyCredential( $username, $password ) )
            {
                return false;
            }

            return true;
        }

        /**
         * Verifying credential for given username and password
         *
         * @param string $username
         * @param string $password
         *
         * @return bool
         */
        private function _verifyCredential( string $username, string $password ): bool
        {
            return ( $arrUser = $this->_getByUsername( $username ) ) && $arrUser['password'] === md5( $password );
        }

        /**
         * @param string $username
         * @param string $password
         *
         * @return bool
         */
        public function createUser( string $username, string $password ): bool
        {
            $result = false;

            try
            {
                if ( ! $schema = $this->objDatabase->getSchema( 'USER' ) )
                {
                    return false;
                }

                $sqlNewUser = "INSERT INTO `{$schema->NAME}` ( `{$schema->FIELDS['USERNAME']['NAME']}`, `{$schema->FIELDS['PASSWORD']['NAME']}` ) VALUES(:username, :password)";

                $qryNewUser = $this->objDatabase->prepare( $sqlNewUser );

                $qryNewUser->bindParam( ':username', $username, PDO::PARAM_STR );
                $qryNewUser->bindParam( ':password', $password, PDO::PARAM_STR );

                if ( $qryNewUser->execute() )
                {
                    $result = true;
                }
            }
            catch ( PDOException $e )
            {
                return false;
            }

            return $result;
        }

        public function changePassword( string $username, string $newPassword ): bool
        {
            if ( ! $this->_getByUsername( $username ) )
            {
                return false;
            }

            $result = false;

            try
            {
                if ( ! $schema = $this->objDatabase->getSchema( 'USER' ) )
                {
                    return false;
                }

                $md5NewPassword = md5( $newPassword );

                $sqlChangePassword = "UPDATE `{$schema->NAME}` SET `{$schema->FIELDS['USERNAME']['NAME']}`=:username, `{$schema->FIELDS['PASSWORD']['NAME']}`=:password";

                $qryChangePassword = $this->objDatabase->prepare( $sqlChangePassword );

                $qryChangePassword->bindParam( ':username', $username, PDO::PARAM_STR );
                $qryChangePassword->bindParam( ':password', $md5NewPassword, PDO::PARAM_STR );

                if ( $qryChangePassword->execute() )
                {
                    $result = true;
                }
            }
            catch ( PDOException $e )
            {
                return false;
            }

            return $result;
        }

    }
}
