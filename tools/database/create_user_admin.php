<?php declare( strict_types=1 );

require_once __DIR__ . "/../../vendor/autoload.php";

use Phpneeds\Libs\Database;
use Phpneeds\Libs\User;

// ********DATABASE*************************
$objDatabase = Database::getInstance();
// ********DATABASE*************************

// ********USER*****************************
$objUser = new User( $objDatabase );
// ********DATABASE*************************

$newPassword = User::getNewRandomPassword( 16 );

$md5Password = md5( $newPassword );

if ( $objUser->createUser( 'admin', $md5Password ) )
{
    // **green** success message
    echo "\n\n\033[32m\u{2713}  User 'admin' created successfuly! \033[0m\n";
    echo "\n\033[32m  Username: admin \033[0m\n";
    echo "\n\033[32m  Password: $newPassword \033[0m\n\n\n";
} else
{
    // **red** error message
    echo "\n\n\033[31m\u{274c}  User could not created! \033[0m\n\n\n";
}
