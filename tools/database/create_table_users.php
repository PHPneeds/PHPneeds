<?php declare( strict_types=1 );

require_once __DIR__ . '/../../libs/Database.php';

use Mertowitch\Phpneeds\Database;

// ********DATABASE*************************
$objDatabase = Database::getInstance();
// ********DATABASE*************************

if ( ! $objDatabase->getSchema( 'USER' ) )
{
    exit( "\n\n\033[31m\u{274c}  'users' not found in schema! \033[0m\n\n\n" );
}

if ( $objDatabase->createTable( 'USER' ) )
{
    echo "\n\n\033[32m\u{2713}  'users' table created successfuly! \033[0m\n\n\n";
} else
{
    echo "\n\n\033[31m\u{274c}  'users' table could not created! \033[0m\n\n\n";
}
