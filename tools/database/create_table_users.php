<?php declare( strict_types=1 );

namespace Mertowitch\Phpneeds;

require_once __DIR__ . "/../../vendor/autoload.php";

// ********DATABASE*************************
$objDatabase = Database::getInstance();
// ********DATABASE*************************

if ( ! $objDatabase->getSchema( 'USER' ) )
{
    exit( "\n\n\033[31m\u{274c}  'users' not found in schema! \033[0m\n\n\n" );
}

if ( $objDatabase->createTable( 'USER' ) )
{
    // **green** success message
    echo "\n\n\033[32m\u{2713}  'users' table created successfuly! \033[0m\n\n\n";
} else
{
    // **red** error message
    echo "\n\n\033[31m\u{274c}  'users' table could not created! \033[0m\n\n\n";
}
