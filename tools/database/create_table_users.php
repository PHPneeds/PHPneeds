<?php declare( strict_types=1 );

namespace Mertowitch\Phpneeds;

require_once __DIR__ . "/../../vendor/autoload.php";

// ********DATABASE*************************
$objDatabase = Database::getInstance();
// ********DATABASE*************************

if ( ! $schema = $objDatabase->getSchema( 'USER' ) )
{
    exit( "\n\n\033[31m\u{274c}  'USER' not found in schema! \033[0m\n\n\n" );
}

if ( $objDatabase->createTable( 'USER' ) )
{
    // **green** success message
    echo "\n\n\033[32m\u{2713}  '{$schema->NAME}' table created successfuly! \033[0m\n\n\n";
} else
{
    // **red** error message
    echo "\n\n\033[31m\u{274c}  '{$schema->NAME}' table could not created! \033[0m\n\n\n";
}
