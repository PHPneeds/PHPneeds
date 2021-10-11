<?php declare( strict_types=1 );

require_once __DIR__ . "/../../../common/init.php";

if ( ! isset( $_GET['f'], $_GET['w'], $_GET['h'], $_GET['q'], $_GET['c'] ) )
{
    header( "HTTP/1.1 404 Not Found" );
    exit;
}

function getHeaders( ...$args )
{
    header( "Content-Type: image/jpeg" );
    header( "Content-Length: " . strlen( $args['output'] ) );
    header( "Last-Modified: " . gmdate( "D, d M Y H:i:s", $args['fileInfo']['modifiedDate'] ) . " GMT" );
    header( "Expires: " . gmdate( "D, d M Y H:i:s", strtotime( '+1 Week' ) ) . " GMT" );
    header( "Etag: " . $args['etag'] );
    header( "Cache-Control: public" );
    header( "Pragma: cache" );
}

function cleanInput( $var ): mixed
{
    $var = trim( $var );
    $var = stripslashes( $var );
    $var = htmlspecialchars( $var );

    return $var;
}

try
{
    $getFilename = cleanInput( $_GET['f'] ) . '.jpg';
    $getWidth    = (int) cleanInput( $_GET['w'] );
    $getHeight   = (int) cleanInput( $_GET['h'] );
    $getQuality  = (int) cleanInput( $_GET['q'] );
    $getCrop     = (bool) cleanInput( $_GET['c'] );
}
catch ( Exception $e )
{
    header( "HTTP/1.1 400 Bad Request" );
    exit;
}

try
{
    $objImage
        ->pick( $getFilename )
        ->setWidth( $getWidth )
        ->setHeight( $getHeight )
        ->setQuality( $getQuality );

    if ( $getCrop === true )
    {
        $objImage->setCrop();
    }

    $output = $objImage
        ->resize()
        ->addWatermark()
        ->getBlob();

    $fileInfo = $objImage->getCachedInfo();

    $etag = md5( $fileInfo['fileRealPath'] . $fileInfo['modifiedDate'] . strlen( $output ) );
}
catch ( \ImagickException $e )
{
    header( "HTTP/1.1 404 Not Found" );
    exit;
}
catch ( \ImagickDrawException $d )
{
    header( "HTTP/1.1 404 Not Found" );
    exit;
}

if ( isset( $_SERVER['HTTP_IF_MODIFIED_SINCE'], $_SERVER['HTTP_IF_NONE_MATCH'] ) )
{
    if ( strtotime( $_SERVER['HTTP_IF_MODIFIED_SINCE'] ) === $fileInfo['modifiedDate'] || trim( $_SERVER['HTTP_IF_NONE_MATCH'] ) === $etag )
    {
        header( "HTTP/1.1 304 Not Modified" );
        getHeaders( output: $output, etag: $etag, fileInfo: $fileInfo );
        exit;
    }
}

getHeaders( output: $output, etag: $etag, fileInfo: $fileInfo );

echo $output;
